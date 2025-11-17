@csrf

<div class="mb-3">
    <label for="title" class="form-label">Titre</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $article->title) }}">
    @error('title')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $article->slug) }}">
    @error('slug')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="excerpt" class="form-label">Extrait</label>
    <textarea name="excerpt" id="excerpt" class="form-control">{{ old('excerpt', $article->excerpt) }}</textarea>
    @error('excerpt')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="content" class="form-label">Contenu</label>
    <textarea name="content" id="content" class="form-control" rows="5">{{ old('content', $article->content) }}</textarea>
    @error('content')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Statut</label>
    <select name="status" class="form-select">
        <option value="brouillon" {{ old('status', $article->status) === 'brouillon' ? 'selected' : '' }}>Brouillon</option>
        <option value="publié" {{ old('status', $article->status) === 'publié' ? 'selected' : '' }}>Publié</option>
    </select>
    @error('status')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Catégories</label>
    <select name="category_ids[]" class="form-select" multiple>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" 
                @if (isset($selectedCategories))
                    {{ in_array($category->id, old('category_ids', $selectedCategories)) ? 'selected' : '' }}
                @else
                    {{ in_array($category->id, old('category_ids', $article->categories->pluck('id')->toArray())) ? 'selected' : '' }}
                @endif
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_ids')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    @error('category_ids.*')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
