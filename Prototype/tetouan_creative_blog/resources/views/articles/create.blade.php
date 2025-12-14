@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Ajouter un article</h1>

        <form method="POST" action="{{ route('articles.store') }}" class="space-y-6">
            @csrf

            {{-- Titre --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Titre <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                       required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Slug --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Slug
                </label>
                <input type="text" 
                       name="slug" 
                       value="{{ old('slug') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                       placeholder="mon-article">
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Extrait --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Extrait
                </label>
                <textarea name="excrept" 
                          rows="3"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('excrept') }}</textarea>
                @error('excrept')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Contenu --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Contenu <span class="text-red-500">*</span>
                </label>
                <textarea name="content" 
                          rows="8"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                          required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Statut --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Statut <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center space-x-6">
                    <label class="inline-flex items-center">
                        <input type="radio" 
                               name="status" 
                               value="publié" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                               {{ old('status') === 'publié' ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Publié</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" 
                               name="status" 
                               value="brouillon" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                               {{ old('status', 'brouillon') === 'brouillon' ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Brouillon</span>
                    </label>
                </div>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Catégories --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Catégories <span class="text-red-500">*</span>
                </label>
                <div class="mt-1 p-4 border border-gray-200 rounded-lg bg-gray-50">
                    @forelse($categories as $category)
                        <div class="flex items-center py-2">
                            <input type="checkbox" 
                                   id="category-{{ $category->id }}"
                                   name="categories[]" 
                                   value="{{ $category->id }}"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                   {{ (is_array(old('categories')) && in_array($category->id, old('categories'))) ? 'checked' : '' }}>
                            <label for="category-{{ $category->id }}" class="ml-2 block text-sm text-gray-700 cursor-pointer">
                                {{ $category->name }}
                            </label>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 italic">Aucune catégorie disponible</p>
                    @endforelse
                </div>
                @error('categories')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bouton --}}
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('articles.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Annuler
                </a>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection