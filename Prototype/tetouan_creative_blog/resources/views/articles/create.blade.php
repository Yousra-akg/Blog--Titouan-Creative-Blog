@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Créer un article</h1>

    <form action="{{ route('articles.store') }}" method="POST">
        @include('articles.form', ['article' => $article, 'categories' => $categories])

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
