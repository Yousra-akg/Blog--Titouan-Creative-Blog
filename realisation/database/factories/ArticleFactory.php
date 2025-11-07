<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $titre = fake()->sentence();
        return [
            'titre' => $titre,
            'slug' => Str::slug($titre),
            'excerpt' => fake()->text(200),
            'contenu' => fake()->paragraphs(5, true),
            'image' => fake()->imageUrl(640, 480, 'articles', true),
            'status' => fake()->randomElement(['publié', 'brouillon', 'programmé']),
            'user_id' => User::factory(),
        ];
    }
}
