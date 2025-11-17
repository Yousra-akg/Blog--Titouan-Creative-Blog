@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Modifier l'article</h1>

    <form action="{{ route('articles.update', $article) }}" method="POST">
        @method('PUT')
        @include('articles.form', ['article' => $article, 'categories' => $categories, 'selectedCategories' => $selectedCategories])

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
