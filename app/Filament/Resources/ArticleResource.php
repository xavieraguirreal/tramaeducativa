<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use App\Models\Tag;
use App\Services\EmbeddingsService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Contenido';

    protected static ?string $modelLabel = 'Artículo';

    protected static ?string $pluralModelLabel = 'Artículos';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contenido Principal')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\Textarea::make('excerpt')
                            ->label('Extracto')
                            ->rows(3)
                            ->columnSpanFull()
                            ->hintAction(
                                Forms\Components\Actions\Action::make('generateExcerpt')
                                    ->label('Generar con IA')
                                    ->icon('heroicon-m-sparkles')
                                    ->color('warning')
                                    ->disabled(fn (Forms\Get $get): bool => empty(strip_tags($get('body') ?? '')))
                                    ->action(function (Forms\Set $set, Forms\Get $get) {
                                        $body = $get('body');
                                        if (empty(strip_tags($body ?? ''))) {
                                            Notification::make()
                                                ->title('Primero escribe el contenido del artículo')
                                                ->warning()
                                                ->send();
                                            return;
                                        }

                                        try {
                                            $service = new EmbeddingsService();
                                            $excerpt = $service->generateExcerpt($body);
                                            $set('excerpt', $excerpt);

                                            Notification::make()
                                                ->title('Extracto generado correctamente')
                                                ->success()
                                                ->send();
                                        } catch (\Exception $e) {
                                            Notification::make()
                                                ->title('Error al generar extracto')
                                                ->body($e->getMessage())
                                                ->danger()
                                                ->send();
                                        }
                                    })
                            ),

                        Forms\Components\RichEditor::make('body')
                            ->label('Contenido')
                            ->required()
                            ->live(onBlur: true)
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'link',
                                'orderedList',
                                'bulletList',
                                'h2',
                                'h3',
                                'blockquote',
                                'codeBlock',
                                'redo',
                                'undo',
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Imagen Destacada')
                    ->schema([
                        Forms\Components\FileUpload::make('featured_image')
                            ->label('Imagen')
                            ->image()
                            ->directory('articles')
                            ->imageEditor()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('featured_image_caption')
                            ->label('Pie de foto / Créditos')
                            ->maxLength(255),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Clasificación')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->label('Categoría')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('author_id')
                            ->label('Autor')
                            ->relationship('author', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('tags')
                            ->label('Etiquetas')
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nombre')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                Forms\Components\TextInput::make('slug')
                                    ->required(),
                            ])
                            ->hintAction(
                                Forms\Components\Actions\Action::make('suggestTags')
                                    ->label('Sugerir con IA')
                                    ->icon('heroicon-m-sparkles')
                                    ->color('warning')
                                    ->disabled(fn (Forms\Get $get): bool => empty(strip_tags($get('body') ?? '')))
                                    ->action(function (Forms\Set $set, Forms\Get $get) {
                                        $body = $get('body');
                                        $title = $get('title');

                                        if (empty(strip_tags($body ?? ''))) {
                                            Notification::make()
                                                ->title('Primero escribe el contenido del artículo')
                                                ->warning()
                                                ->send();
                                            return;
                                        }

                                        try {
                                            $service = new EmbeddingsService();
                                            $suggestedTags = $service->suggestTags($title . "\n\n" . $body);

                                            // Buscar o crear tags
                                            $tagIds = [];
                                            foreach ($suggestedTags as $tagName) {
                                                $tag = Tag::firstOrCreate(
                                                    ['slug' => Str::slug($tagName)],
                                                    ['name' => $tagName]
                                                );
                                                $tagIds[] = $tag->id;
                                            }

                                            // Combinar con tags existentes
                                            $currentTags = $get('tags') ?? [];
                                            $mergedTags = array_unique(array_merge($currentTags, $tagIds));
                                            $set('tags', $mergedTags);

                                            Notification::make()
                                                ->title('Etiquetas sugeridas agregadas')
                                                ->body('Se sugirieron ' . count($suggestedTags) . ' etiquetas')
                                                ->success()
                                                ->send();
                                        } catch (\Exception $e) {
                                            Notification::make()
                                                ->title('Error al sugerir etiquetas')
                                                ->body($e->getMessage())
                                                ->danger()
                                                ->send();
                                        }
                                    })
                            ),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Publicación')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Estado')
                            ->options([
                                'draft' => 'Borrador',
                                'review' => 'En revisión',
                                'published' => 'Publicado',
                            ])
                            ->default('draft')
                            ->required()
                            ->native(false),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Destacado')
                            ->helperText('Mostrar en la sección principal'),

                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Fecha de publicación')
                            ->default(now()),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Resumen IA')
                    ->schema([
                        Forms\Components\Textarea::make('ai_summary')
                            ->label('Puntos clave (generado por IA)')
                            ->rows(4)
                            ->columnSpanFull()
                            ->helperText('Este campo se genera automáticamente. Puede editarlo si lo desea.')
                            ->hintAction(
                                Forms\Components\Actions\Action::make('generateAiSummary')
                                    ->label('Generar con IA')
                                    ->icon('heroicon-m-sparkles')
                                    ->color('warning')
                                    ->disabled(fn (Forms\Get $get): bool => empty(strip_tags($get('body') ?? '')))
                                    ->action(function (Forms\Set $set, Forms\Get $get) {
                                        $body = $get('body');
                                        $title = $get('title');

                                        if (empty(strip_tags($body ?? ''))) {
                                            Notification::make()
                                                ->title('Primero escribe el contenido del artículo')
                                                ->warning()
                                                ->send();
                                            return;
                                        }

                                        try {
                                            $service = new EmbeddingsService();
                                            $summary = $service->generateSummaryFromText($title . "\n\n" . $body);
                                            $set('ai_summary', $summary);

                                            Notification::make()
                                                ->title('Resumen generado correctamente')
                                                ->success()
                                                ->send();
                                        } catch (\Exception $e) {
                                            Notification::make()
                                                ->title('Error al generar resumen')
                                                ->body($e->getMessage())
                                                ->danger()
                                                ->send();
                                        }
                                    })
                            ),
                    ])
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Img')
                    ->circular()
                    ->size(40)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(40)
                    ->wrap()
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 40 ? $state : null;
                    }),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoría')
                    ->badge()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('author.name')
                    ->label('Autor')
                    ->sortable()
                    ->limit(15)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'review' => 'warning',
                        'published' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Borrador',
                        'review' => 'Revisión',
                        'published' => 'Publicado',
                        default => $state,
                    }),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Dest.')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('views')
                    ->label('Vistas')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'draft' => 'Borrador',
                        'review' => 'En revisión',
                        'published' => 'Publicado',
                    ]),

                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Categoría')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\SelectFilter::make('author_id')
                    ->label('Autor')
                    ->relationship('author', 'name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Destacados'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
