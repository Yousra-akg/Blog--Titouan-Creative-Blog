<?php

// app/Http/Controllers/Admin/ArticleController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    protected ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category', 'status']);
        $articles = $this->articleService->getPaginatedArticles($filters, 10);

        $categories = Category::orderBy('name')->get();

        return view('articles.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:180',
            'content' => 'required',
            'status' => 'required|in:publié,brouillon',
            'excerpt' => 'nullable|string',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        $this->articleService->createArticle($request->all());

        return redirect()->route('articles.index')->with('success', 'Article créé !');
    }

    public function edit(Article $article)
    {
        $categories = Category::orderBy('name')->get();
        $article->load('categories');

        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:180',
            'content' => 'required',
            'status' => 'required|in:publié,brouillon',
            'excerpt' => 'nullable|string',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        $this->articleService->updateArticle($article, $request->all());

        return redirect()->route('articles.index')->with('success', 'Article mis à jour !');
    }

    public function destroy(Article $article)
    {
        $this->articleService->deleteArticle($article);
        return back()->with('success', 'Article supprimé');
    }

public function uploadImage(Request $request)
{
    $request->validate([
        'file' => 'required|image|max:2048', // 2MB max
    ]);

    $path = $request->file('file')->store('public/articles');
    $url = Storage::url($path);
    
    return response()->json(['url' => $url]);
}
}