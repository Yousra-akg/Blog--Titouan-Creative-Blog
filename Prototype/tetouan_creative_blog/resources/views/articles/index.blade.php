@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- En-tête -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Liste des articles</h1>
            @can('create article')
            <a href="{{ route('articles.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded flex items-center">
                <i class="fas fa-plus mr-2"></i> Ajouter un article
            </a>
            @endcan
    </div>

    <!-- Message de succès -->
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filtre -->
    <div class="mb-6">
        <form method="GET" action="{{ route('articles.index') }}" class="flex items-center">
            <label for="category_id" class="mr-2">Filtrer par catégorie :</label>
            <select 
                name="category_id" 
                id="category_id" 
                onchange="this.form.submit()"
                class="border rounded px-3 py-1"
            >
                <option value="">Toutes les catégories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ (int) $currentCategoryId === $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Tableau -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégories</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($articles as $article)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $article->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                {{ $article->title }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                @foreach ($article->categories as $category)
                                    <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $article->status === 'publié' ? 'bg-green-100 text-green-800' : 
                                   ($article->status === 'brouillon' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($article->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $article->created_at?->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                @can('delete article')
                                    @if(auth()->user()->hasRole('admin') || auth()->id() == $article->user_id)
                                        <form action="{{ route('articles.destroy', $article) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?');"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900"
                                                    title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Aucun article trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($articles->hasPages())
        <div class="mt-4">
            {{ $articles->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection