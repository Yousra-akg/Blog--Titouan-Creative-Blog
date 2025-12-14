<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Définir à la fois la racine et /articles pour la même méthode
    Route::get('/', [ArticleController::class, 'index'])->name('home.articles');
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    
    Route::get('/articles/create', [ArticleController::class, 'create'])
        ->middleware('permission:create article')
        ->name('articles.create');
        
    Route::post('/articles', [ArticleController::class, 'store'])
        ->middleware('permission:create article')
        ->name('articles.store');
        
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])
        ->middleware('permission:delete article')
        ->name('articles.destroy');
});

Auth::routes();