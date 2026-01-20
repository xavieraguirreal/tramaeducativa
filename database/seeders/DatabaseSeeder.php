<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Trama',
            'email' => 'admin@tramaeducativa.ar',
        ]);

        $this->call([
            CategorySeeder::class,
            AuthorSeeder::class,
            ArticleSeeder::class,
            TagSeeder::class,
        ]);
    }
}
