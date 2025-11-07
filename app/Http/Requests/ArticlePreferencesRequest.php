<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticlePreferencesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'preferred_sources' => 'required|array|min:1',
            'preferred_sources.*' => 'string|in:NewsAPI,The Guardian,NY Times',
            'preferred_categories' => 'nullable|array',
            'preferred_categories.*' => 'string|max:100',
            'preferred_authors' => 'nullable|array',
            'preferred_authors.*' => 'string|max:255',
            'filter.keyword' => 'nullable|string|max:255',
            'filter.date_range' => 'nullable|array',
            'filter.date_range.from' => 'nullable|date',
            'filter.date_range.to' => 'nullable|date',
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:100',
        ];
    }
}
