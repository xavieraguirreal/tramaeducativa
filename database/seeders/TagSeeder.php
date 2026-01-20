<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Docentes',
            'Paritarias',
            'UNMDP',
            'Primaria',
            'Secundaria',
            'Terciarios',
            'Infraestructura',
            'Presupuesto',
            'Reforma',
            'Capacitacion',
            'Tecnologia',
            'Inclusion',
            'Alimentacion',
            'Transporte',
            'Becas',
            'Investigacion',
            'Cultura',
            'Derechos',
            'Politicas Publicas',
            'Mar del Plata',
        ];

        foreach ($tags as $tagName) {
            Tag::create([
                'name' => $tagName,
                'slug' => Str::slug($tagName),
            ]);
        }

        // Attach random tags to articles
        $allTags = Tag::all();
        $articles = Article::all();

        foreach ($articles as $article) {
            $randomTags = $allTags->random(rand(2, 5));
            $article->tags()->attach($randomTags->pluck('id'));
        }
    }
}
