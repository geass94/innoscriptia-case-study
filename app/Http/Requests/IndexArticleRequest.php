<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexArticleRequest extends FormRequest
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
            'filter.keyword' => 'nullable|string|max:255',
            'filter.source' => 'nullable|string|in:NewsAPI,The Guardian,NY Times',
            'filter.sources' => 'nullable|array',
            'filter.sources.*' => 'string|in:NewsAPI,The Guardian,NY Times',
            'filter.category' => 'nullable|string|max:100',
            'filter.categories' => 'nullable|array',
            'filter.categories.*' => 'string|max:100',
            'filter.author' => 'nullable|string|max:255',
            'filter.authors' => 'nullable|array',
            'filter.authors.*' => 'string|max:255',
            'filter.date_range' => 'nullable|array',
            'filter.date_range.from' => 'nullable|date',
            'filter.date_range.to' => 'nullable|date',
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:100',
            'sort' => 'nullable|string|in:published_at,-published_at,created_at,-created_at,title,-title',
        ];
    }
}
