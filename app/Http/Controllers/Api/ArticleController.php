<?php

namespace App\Http\Controllers\Api;

use App\Data\Responses\CollectionResponse;
use App\DTOs\ArticleDTO;
use App\Filters\AuthorFilter;
use App\Filters\CategoryFilter;
use App\Filters\DateRangeFilter;
use App\Filters\KeywordFilter;
use App\Filters\SourceFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticlePreferencesRequest;
use App\Http\Requests\IndexArticleRequest;
use App\Models\Article;
use Illuminate\Http\Response;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ArticleController extends Controller
{
    public function index(IndexArticleRequest $request): PaginatedDataCollection
    {
        $articles = QueryBuilder::for(Article::class)
            ->allowedFilters([
                AllowedFilter::custom('keyword', new KeywordFilter),
                AllowedFilter::custom('source', new SourceFilter),
                AllowedFilter::custom('sources', new SourceFilter),
                AllowedFilter::custom('category', new CategoryFilter),
                AllowedFilter::custom('categories', new CategoryFilter),
                AllowedFilter::custom('author', new AuthorFilter),
                AllowedFilter::custom('authors', new AuthorFilter),
                AllowedFilter::custom('date_range', new DateRangeFilter),
            ])
            ->allowedSorts(['published_at', 'created_at', 'title'])
            ->defaultSort('-published_at')
            ->paginate($request->get('per_page', 15));

        return ArticleDTO::collect($articles, PaginatedDataCollection::class);
    }

    public function show(int $id): ArticleDTO|Response
    {
        $article = Article::query()->find($id);

        if (! $article) {
            return response()->json([
                'message' => 'Article not found',
            ], 404);
        }

        return ArticleDTO::fromModel($article);
    }

    public function sources(): CollectionResponse
    {
        $sources = Article::query()->select('source')
            ->distinct()
            ->orderBy('source')
            ->pluck('source')
            ->toArray();

        return new CollectionResponse(data: $sources);
    }

    public function categories(): CollectionResponse
    {
        $categories = Article::query()->select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->toArray();

        return new CollectionResponse(data: $categories);
    }

    /**
     * Get available authors
     */
    public function authors(): CollectionResponse
    {
        $authors = Article::query()->select('author')
            ->whereNotNull('author')
            ->distinct()
            ->orderBy('author')
            ->pluck('author')
            ->toArray();

        return new CollectionResponse(data: $authors);
    }

    /**
     * Get user preferences filtered articles
     *
     * This endpoint allows frontend to save user preferences
     * and retrieve articles based on those preferences
     */
    public function preferences(ArticlePreferencesRequest $request): PaginatedDataCollection
    {
        // Build query starting with required preferred sources
        $query = Article::query()->whereIn('source', $request->preferred_sources);

        // Apply optional preferred categories
        if ($request->filled('preferred_categories')) {
            $query->whereIn('category', $request->preferred_categories);
        }

        // Apply optional preferred authors
        if ($request->filled('preferred_authors')) {
            $query->whereIn('author', $request->preferred_authors);
        }

        // Use QueryBuilder for additional filtering
        $articles = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::custom('keyword', new KeywordFilter),
                AllowedFilter::custom('date_range', new DateRangeFilter),
            ])
            ->defaultSort('-published_at')
            ->paginate($request->get('per_page', 15));

        return ArticleDTO::collect($articles, PaginatedDataCollection::class);
    }
}
