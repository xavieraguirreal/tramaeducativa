<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Services\EmbeddingsService;
use Illuminate\Console\Command;

class GenerateEmbeddings extends Command
{
    protected $signature = 'articles:generate-embeddings
                            {--all : Regenerar todos los embeddings}
                            {--article= : ID de un articulo especifico}';

    protected $description = 'Genera embeddings para articulos usando OpenAI';

    public function handle(EmbeddingsService $embeddings): int
    {
        if (!config('services.openai.api_key')) {
            $this->error('OPENAI_API_KEY no configurada en .env');
            return Command::FAILURE;
        }

        $query = Article::published();

        if ($articleId = $this->option('article')) {
            $query->where('id', $articleId);
        } elseif (!$this->option('all')) {
            // Solo articulos sin embedding o con contenido modificado
            $query->where(function ($q) {
                $q->whereNull('embedding')
                  ->orWhereNull('embedding_hash');
            });
        }

        $articles = $query->get();

        if ($articles->isEmpty()) {
            $this->info('No hay articulos que procesar.');
            return Command::SUCCESS;
        }

        $this->info("Procesando {$articles->count()} articulos...");
        $bar = $this->output->createProgressBar($articles->count());
        $bar->start();

        $success = 0;
        $errors = 0;
        $totalTokens = 0;

        foreach ($articles as $article) {
            try {
                // Calcular hash del contenido actual
                $contentHash = hash('sha256', $article->title . $article->body . $article->excerpt);

                // Si ya tiene embedding y el hash coincide, saltar
                if (!$this->option('all') && $article->embedding_hash === $contentHash) {
                    $bar->advance();
                    continue;
                }

                $result = $embeddings->generateArticleEmbedding($article);

                $article->update([
                    'embedding' => json_encode($result['embedding']),
                    'embedding_hash' => $contentHash,
                ]);

                $totalTokens += $result['tokens'];
                $success++;
            } catch (\Exception $e) {
                $this->newLine();
                $this->error("Error en articulo {$article->id}: " . $e->getMessage());
                $errors++;
            }

            $bar->advance();

            // Pausa para no exceder rate limits
            usleep(100000); // 100ms
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("Completado: {$success} exitosos, {$errors} errores");
        $this->info("Tokens utilizados: {$totalTokens}");

        return $errors > 0 ? Command::FAILURE : Command::SUCCESS;
    }
}
