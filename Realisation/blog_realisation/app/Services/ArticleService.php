<?php

namespace App\Services;

use App\Models\Article;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class ArticleService
{
    protected User $adminUser;

   public function __construct()
{
    $this->adminUser = User::where('role', 'admin')->first() 
        ?? User::first() 
        ?? User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
}

    public function getPaginatedArticles(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        return $this->applyFilters(Article::query(), $filters)
            ->with('categories', 'user')
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    public function createArticle(array $data): Article
    {
        $data['user_id'] = $this->adminUser->id;
        $data['slug'] = \Str::slug($data['title']);

        $article = Article::create($data);

        if (!empty($data['categories'] ?? [])) {
            $article->categories()->sync($data['categories']);
        }

        return $article->load('categories');
    }

    public function updateArticle(Article $article, array $data): Article
    {
        if (isset($data['title'])) {
            $data['slug'] = \Str::slug($data['title']);
        }

        $article->update($data);

        $categoryIds = $data['categories'] ?? [];
        $article->categories()->sync($categoryIds);

        return $article->load('categories');
    }

    public function deleteArticle(Article $article): void
    {
        $article->categories()->detach();
        $article->delete();
    }

    protected function applyFilters(Builder $query, array $filters): Builder
{
    if (!empty($filters['search'])) {
        $search = $filters['search'];
        $query->where('title', 'like', "%{$search}%");
    }

    if (!empty($filters['category'])) {
        $query->whereHas('categories', function($q) use ($filters) {
            $q->where('categories.id', $filters['category']); 
        });
    }

    if (!empty($filters['status'])) {
        $query->where('articles.status', $filters['status']); 
    }

    return $query;
}

    public function getAdminUser(): User
    {
        return $this->adminUser;
    }
}