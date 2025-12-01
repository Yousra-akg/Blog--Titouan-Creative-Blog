@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Gestion des Articles</h1>

    <div class="flex justify-between mb-6">
        <a href="{{ route('articles.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            Nouvel article
        </a>
    </div>

    <!-- resources/views/admin/articles/index.blade.php -->

<!-- Remplace tout le formulaire de filtres par celui-ci -->
<div class="bg-white p-5 rounded-lg shadow mb-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Recherche en temps réel sur le titre -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Recherche par titre</label>
            <input 
                type="text" 
                id="live-search" 
                value="{{ request('search') }}" 
                placeholder="Tapez pour chercher instantanément..."
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                autocomplete="off"
            >
        </div>

        <!-- Filtre catégorie (classique) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
            <select id="category-filter" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                <option value="">Toutes les catégories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filtre statut -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
            <select id="status-filter" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                <option value="">Tous les statuts</option>
                <option value="publié" {{ request('status') == 'publié' ? 'selected' : '' }}>Publié</option>
                <option value="brouillon" {{ request('status') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
            </select>
        </div>
    </div>
</div>

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left">Titre</th>
                    <th class="px-6 py-3">Statut</th>
                    <th class="px-6 py-3">Catégories</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                <tr>
                    <td class="px-6 py-4">{{ Str::limit($article->title, 50) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-sm {{ $article->status == 'publié' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $article->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        {{ $article->categories->pluck('name')->implode(', ') }}
                    </td>
                    <td class="px-6 py-4 text-sm">{{ $article->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('articles.edit', $article) }}" class="text-blue-600 hover:text-blue-800" title="Modifier">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')" class="text-red-600 hover:text-red-800" title="Supprimer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-8">Aucun article</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $articles->appends(request()->query())->links() }}
    </div>
</div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('live-search');
    const categorySelect = document.getElementById('category-filter');
    const statusSelect = document.getElementById('status-filter');

    function performSearch() {
        const params = new URLSearchParams();

        // Ajouter la recherche seulement si le champ n'est pas vide
        const searchValue = searchInput.value.trim();
        if (searchValue !== '') {
            params.append('search', searchValue);
        }

        // Ajouter les filtres si sélectionnés
        if (categorySelect.value) {
            params.append('category', categorySelect.value);
        }
        if (statusSelect.value) {
            params.append('status', statusSelect.value);
        }

        // Recharger la page avec les bons paramètres
        const newUrl = `${window.location.pathname}?${params.toString()}`;
        window.location.href = newUrl;
    }

    let timeout;
    searchInput.addEventListener('input', function () {
        clearTimeout(timeout);
        timeout = setTimeout(performSearch, 400);
    });

    categorySelect.addEventListener('change', performSearch);
    statusSelect.addEventListener('change', performSearch);

    // Option bonus : Effacer la recherche avec la touche Échap
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            searchInput.value = '';
            performSearch();
        }
    });
});
</script>