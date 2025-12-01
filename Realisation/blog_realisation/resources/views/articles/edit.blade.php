@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-4xl">
    <h1 class="text-3xl font-bold mb-6">{{ isset($article) ? 'Modifier' : 'Créer' }} un article</h1>

    <form action="{{ isset($article) ? route('articles.update', $article) : route('articles.store') }}" method="POST">
        @csrf
        @if(isset($article)) @method('PUT') @endif

        <div class="bg-white p-6 rounded shadow space-y-6">
            <div>
                <label class="block font-medium">Titre</label>
                <input type="text" name="title" value="{{ old('title', $article->title ?? '') }}" required
                       class="w-full border rounded px-3 py-2 mt-1">
                @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-medium">Extrait (facultatif)</label>
                <textarea name="excerpt" rows="3" class="w-full border rounded px-3 py-2">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
            </div>

            <div>
                <label class="block font-medium">Contenu</label>

<!-- Tiptap Éditeur – Version BLANC ÉPURÉ -->
<div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm bg-white">
  <div id="hs-editor-tiptap">
    <!-- Barre d'outils – fond blanc, boutons ronds très clean -->
    <div class="sticky top-0 z-10 bg-white border-b border-gray-100 px-3 py-2.5 flex flex-wrap items-center gap-1.5">
      <button type="button" data-hs-editor-bold class="editor-btn-clean">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 12a4 4 0 0 0 0-8H6v8"></path><path d="M15 20a4 4 0 0 0 0-8H6v8Z"></path></svg>
      </button>
      <button type="button" data-hs-editor-italic class="editor-btn-clean">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="19" x2="10" y1="4" y2="4"></line><line x1="14" x2="5" y1="20" y2="20"></line><line x1="15" x2="9" y1="4" y2="20"></line></svg>
      </button>
      <button type="button" data-hs-editor-underline class="editor-btn-clean">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 4v6a6 6 0 0 0 12 0V4"></path><line x1="4" x2="20" y1="20" y2="20"></line></svg>
      </button>
      <button type="button" data-hs-editor-strike class="editor-btn-clean">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 4H9a3 3 0 0 0-2.83 4"></path><path d="M14 12a4 4 0 0 1 0 8H6"></path><line x1="4" x2="20" y1="12" y2="12"></line></svg>
      </button>

      <span class="w-px h-6 bg-gray-200 mx-1"></span>

      <button type="button" data-hs-editor-link class="editor-btn-clean">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
      </button>
      <button type="button" data-hs-editor-ul class="editor-btn-clean">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="8" x2="21" y1="6" y2="6"></line><line x1="8" x2="21" y1="12" y2="12"></line><line x1="8" x2="21" y1="18" y2="18"></line><circle cx="4" cy="6" r="1"></circle><circle cx="4" cy="12" r="1"></circle><circle cx="4" cy="18" r="1"></circle></svg>
      </button>
      <button type="button" data-hs-editor-ol class="editor-btn-clean">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="10" x2="21" y1="6" y2="6"></line><line x1="10" x2="21" y1="12" y2="12"></line><line x1="10" x2="21" y1="18" y2="18"></line><text x="3" y="9" class="text-xs">1</text><text x="3" y="15" class="text-xs">2</text><text x="3" y="21" class="text-xs">3</text></svg>
      </button>
      <button type="button" data-hs-editor-blockquote class="editor-btn-clean">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12h6l3-9 3 9h6"></path></svg>
      </button>
    </div>

    <!-- Zone de texte -->
    <div 
      class="min-h-96 px-6 py-5 prose prose-lg max-w-none focus:outline-none"
      data-hs-editor-field
      contenteditable="true">
      {!! old('content', $article->content ?? '') !!}
    </div>
    <input type="hidden" name="content" id="editor-content" value="{!! old('content', $article->content ?? '') !!}">
  </div>
</div>
<!-- Fin Tiptap -->

<!-- Script pour gérer la soumission du formulaire avec Tiptap -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const editorElement = document.querySelector('[data-hs-editor-field]');
    const hiddenInput = document.getElementById('editor-content');

    form.addEventListener('submit', function(e) {
        // Met à jour le champ caché avec le contenu de l'éditeur
        hiddenInput.value = editorElement.innerHTML;
    });
});
</script>

            <div class="mb-6">
                <label class="block font-medium text-gray-700 mb-2">Statut de publication</label>
                <div class="flex space-x-4">
                    <label class="inline-flex items-center">
                        <input 
                            type="radio" 
                            name="status" 
                            value="brouillon" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                            {{ old('status', $article->status ?? 'brouillon') == 'brouillon' ? 'checked' : '' }}
                        >
                        <span class="ml-2 text-gray-700">Brouillon</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input 
                            type="radio" 
                            name="status" 
                            value="publié" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                            {{ old('status', $article->status ?? '') == 'publié' ? 'checked' : '' }}
                        >
                        <span class="ml-2 text-gray-700">Publié</span>
                    </label>
                </div>
            </div>

            <div class="mb-6">
                <label class="block font-medium text-gray-700 mb-2">Catégories</label>
                
                <div class="border border-gray-300 rounded-md p-2 max-h-60 overflow-y-auto">
                    @php
                        $selectedCategories = [];
                        if (isset($article)) {
                            $selectedCategories = $article->categories->pluck('id')->toArray();
                        } elseif (old('categories')) {
                            $selectedCategories = old('categories');
                        }
                    @endphp
                    
                    @foreach($categories as $category)
                        <div class="flex items-center py-2 px-1 hover:bg-gray-50 rounded">
                            <input 
                                type="checkbox" 
                                id="category-{{ $category->id }}" 
                                name="categories[]" 
                                value="{{ $category->id }}"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}
                            >
                            <label for="category-{{ $category->id }}" class="ml-2 text-gray-700">{{ $category->name }}</label>
                        </div>
                    @endforeach
                </div>
                
                <style>
                    /* Style personnalisé pour la barre de défilement */
                    .overflow-y-auto::-webkit-scrollbar {
                        width: 6px;
                    }
                    
                    .overflow-y-auto::-webkit-scrollbar-track {
                        background: #f3f4f6;
                        border-radius: 3px;
                    }
                    
                    .overflow-y-auto::-webkit-scrollbar-thumb {
                        background-color: #9ca3af;
                        border-radius: 3px;
                    }
                    
                    .overflow-y-auto {
                        scrollbar-width: thin;
                        scrollbar-color: #9ca3af #f3f4f6;
                    }
                </style>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded">
                    {{ isset($article) ? 'Mettre à jour' : 'Publier l’article' }}
                </button>
                <a href="{{ route('articles.index') }}" class="text-gray-600">Annuler</a>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 400,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    });
</script>
@endsection