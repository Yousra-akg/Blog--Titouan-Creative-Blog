@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $article->title }}</h5>
                    <div>
                        <span class="badge {{ $article->status === 'publié' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($article->status) }}
                        </span>
                        <a href="{{ route('articles.edit', $article) }}" class="btn btn-sm btn-outline-primary ms-2">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                        <a href="{{ route('articles.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        @if($article->categories->count() > 0)
                            <div class="mb-3">
                                @foreach($article->categories as $category)
                                    <span class="badge bg-primary">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        @endif

                        @if($article->excerpt)
                            <div class="lead mb-4">{{ $article->excerpt }}</div>
                        @endif

                        <div class="article-content">
                            {!! $article->content !!}
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <div class="d-flex justify-content-between align-items-center text-muted">
                            <small>
                                Créé le {{ $article->created_at->format('d/m/Y à H:i') }}
                                @if($article->updated_at->gt($article->created_at))
                                    <br>Dernière mise à jour : {{ $article->updated_at->format('d/m/Y à H:i') }}
                                @endif
                            </small>
                            <div>
                                <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .article-content {
        line-height: 1.8;
    }
    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.375rem;
        margin: 1.5rem 0;
    }
    .article-content h2, 
    .article-content h3, 
    .article-content h4 {
        margin-top: 1.5em;
        margin-bottom: 0.8em;
        font-weight: 600;
    }
    .article-content p {
        margin-bottom: 1.2em;
    }
    .article-content ul, 
    .article-content ol {
        margin-bottom: 1.2em;
        padding-left: 1.5em;
    }
    .article-content a {
        color: #0d6efd;
        text-decoration: none;
    }
    .article-content a:hover {
        text-decoration: underline;
    }
</style>
@endsection