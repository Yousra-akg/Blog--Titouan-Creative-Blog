<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['required', 'string', 'max:200', 'unique:articles,slug'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Le titre est obligatoire',
            'title.max' => 'Le titre ne doit pas dépasser 180 caractères',
            'slug.required' => 'Le slug est obligatoire',
            'slug.max' => 'Le slug ne doit pas dépasser 200 caractères',
            'slug.unique' => 'Ce slug est déjà utilisé',
            'excerpt.string' => 'Le résumé doit être une chaîne de caractères',
            'content.string' => 'Le contenu doit être une chaîne de caractères',
        ];
    }
}
