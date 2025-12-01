<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('articles', ArticleController::class)->only(['index', 'destroy']);

Route::resource('articles', ArticleController::class);

Route::post('/articles/upload-image', [ArticleController::class, 'uploadImage'])
    ->name('articles.upload-image');