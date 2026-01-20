<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            [
                'name' => 'Aylen Aurellio',
                'slug' => 'aylen-aurellio',
                'email' => 'aylen@tramaeducativa.ar',
                'bio' => 'Directora responsable de Trama Educativa. Periodista especializada en educacion y politica educativa.',
                'social_links' => ['twitter' => '@AylenAurellio'],
            ],
            [
                'name' => 'Eugenia Garita',
                'slug' => 'eugenia-garita',
                'email' => 'eugenia@tramaeducativa.ar',
                'bio' => 'Editora de Trama Educativa. Comunicadora social con enfoque en temas universitarios y gremiales.',
                'social_links' => ['twitter' => '@EugeniaGarita'],
            ],
            [
                'name' => 'Redaccion Trama',
                'slug' => 'redaccion',
                'email' => 'redaccion@tramaeducativa.ar',
                'bio' => 'Equipo de redaccion de Trama Educativa.',
                'social_links' => null,
            ],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
