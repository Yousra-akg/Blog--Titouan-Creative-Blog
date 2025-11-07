<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commentaire;
use App\Models\Article;
use App\Models\User;

class CommentaireSeeder extends Seeder
{
    public function run(): void
    {
        $articles = Article::all();
        $users = User::all();

        // Créer 3-5 commentaires par article
        $articles->each(function ($article) use ($users) {
            Commentaire::factory()
                ->count(rand(3, 5))
                ->create([
                    'article_id' => $article->id,
                    'user_id' => $users->random()->id,
                ]);
        });
    }
}