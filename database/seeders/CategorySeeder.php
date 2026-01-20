<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Locales', 'slug' => 'locales', 'color' => '#C84347', 'order' => 1],
            ['name' => 'Universidad', 'slug' => 'universidad', 'color' => '#2563EB', 'order' => 2],
            ['name' => 'Gremiales', 'slug' => 'gremiales', 'color' => '#059669', 'order' => 3],
            ['name' => 'Politica Educativa', 'slug' => 'politica-educativa', 'color' => '#7C3AED', 'order' => 4],
            ['name' => 'Cultura', 'slug' => 'cultura', 'color' => '#DB2777', 'order' => 5],
            ['name' => 'Ciencia y Tecnologia', 'slug' => 'ciencia-tecnologia', 'color' => '#0891B2', 'order' => 6],
            ['name' => 'Ambiente', 'slug' => 'ambiente', 'color' => '#65A30D', 'order' => 7],
            ['name' => 'Columnas', 'slug' => 'columnas', 'color' => '#EA580C', 'order' => 8],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
