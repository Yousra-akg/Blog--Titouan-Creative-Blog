<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentaireFactory extends Factory
{
    public function definition(): array
    {
        return [
            'contenu' => fake()->paragraph(),
            'article_id' => Article::factory(),
            'user_id' => User::factory(),
        ];
    }
}