<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TagSeeder::class,
            ArticleSeeder::class,
            CategorySeeder::class,
            PivotArticleTagSeeder::class,
            PivotArticleCategorySeeder::class,
        ]);

        // Créer un utilisateur admin par défaut si aucun n'existe
        if (\App\Models\User::count() === 0) {
            \App\Models\User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ])->assignRole('admin');
        }
    }
}
