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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ArticleController extends Controller
{
    /**
     * List articles
     *
     * Retrieve a paginated list of articles with optional filtering and sorting.
     *
     * @group Articles
     *
     * @queryParam page integer Page number for pagination. Example: 1
     * @queryParam per_page integer Number of items per page (1-100). Example: 15
     * @queryParam sort string Sort field and direction. Prefix with - for descending. Example: -published_at
     * @queryParam filter[keyword] string Search keyword in title, description, and content. Example: technology
     * @queryParam filter[source] string Filter by a single source. Example: NewsAPI
     * @queryParam filter[sources][] string[] Filter by multiple sources. Example: NewsAPI
     * @queryParam filter[category] string Filter by a single category. Example: business
     * @queryParam filter[categories][] string[] Filter by multiple categories. Example: business
     * @queryParam filter[author] string Filter by a single author name. Example: John Doe
     * @queryParam filter[authors][] string[] Filter by multiple authors. Example: John Doe
     * @queryParam filter[date_range][from] string Filter articles from this date (Y-m-d format). Example: 2024-01-01
     * @queryParam filter[date_range][to] string Filter articles to this date (Y-m-d format). Example: 2024-12-31
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "externalId": "abc123",
     *       "source": "NewsAPI",
     *       "title": "Breaking News: Tech Innovation",
     *       "description": "A comprehensive look at the latest tech innovations",
     *       "content": "Full article content here...",
     *       "url": "https://example.com/article",
     *       "imageUrl": "https://example.com/image.jpg",
     *       "author": "John Doe",
     *       "category": "technology",
     *       "publishedAt": "2024-01-15T10:30:00.000Z",
     *       "contentHash": "hash123",
     *       "createdAt": "2024-01-15T10:30:00.000Z",
     *       "updatedAt": "2024-01-15T10:30:00.000Z"
     *     }
     *   ],
     *   "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 10,
     *     "per_page": 15,
     *     "to": 15,
     *     "total": 150
     *   }
     * }
     */
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

    /**
     * Get a single article
     *
     * Retrieve detailed information about a specific article by its ID.
     *
     * @group Articles
     *
     * @urlParam id integer required The article ID. Example: 1
     *
     * @response 200 {
     *   "id": 1,
     *   "externalId": "abc123",
     *   "source": "NewsAPI",
     *   "title": "Breaking News: Tech Innovation",
     *   "description": "A comprehensive look at the latest tech innovations",
     *   "content": "Full article content here...",
     *   "url": "https://example.com/article",
     *   "imageUrl": "https://example.com/image.jpg",
     *   "author": "John Doe",
     *   "category": "technology",
     *   "publishedAt": "2024-01-15T10:30:00.000Z",
     *   "contentHash": "hash123",
     *   "createdAt": "2024-01-15T10:30:00.000Z",
     *   "updatedAt": "2024-01-15T10:30:00.000Z"
     * }
     * @response 404 {
     *   "message": "Article not found"
     * }
     */
    public function show(int $id): ArticleDTO|JsonResponse
    {
        $article = Article::query()->find($id);

        if (! $article) {
            return response()->json([
                'message' => 'Article not found',
            ], 404);
        }

        return ArticleDTO::fromModel($article);
    }

    /**
     * Get available sources
     *
     * Retrieve a list of all distinct news sources available in the system.
     * This endpoint is useful for populating filter dropdowns.
     *
     * @group Filter Options
     *
     * @response 200 {
     *   "data": [
     *     "NewsAPI",
     *     "The Guardian",
     *     "NY Times"
     *   ]
     * }
     */
    public function sources(): CollectionResponse
    {
        $sources = Article::query()->select('source')
            ->distinct()
            ->orderBy('source')
            ->pluck('source')
            ->toArray();

        return new CollectionResponse(data: $sources);
    }

    /**
     * Get available categories
     *
     * Retrieve a list of all distinct article categories available in the system.
     * This endpoint is useful for populating filter dropdowns.
     *
     * @group Filter Options
     *
     * @response 200 {
     *   "data": [
     *     "business",
     *     "entertainment",
     *     "health",
     *     "science",
     *     "sports",
     *     "technology"
     *   ]
     * }
     */
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
     *
     * Retrieve a list of all distinct article authors available in the system.
     * This endpoint is useful for populating filter dropdowns.
     *
     * @group Filter Options
     *
     * @response 200 {
     *   "data": [
     *     "Jane Smith",
     *     "John Doe",
     *     "Sarah Johnson"
     *   ]
     * }
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
     * Get personalized articles
     *
     * Retrieve articles filtered by user preferences. This endpoint allows you to fetch
     * articles based on preferred sources, categories, and authors, with additional
     * keyword and date range filtering capabilities.
     *
     * @group Articles
     *
     * @bodyParam preferred_sources string[] required Array of preferred news sources. Example: ["NewsAPI", "The Guardian"]
     * @bodyParam preferred_categories string[] Array of preferred categories. Example: ["technology", "business"]
     * @bodyParam preferred_authors string[] Array of preferred authors. Example: ["John Doe", "Jane Smith"]
     * @bodyParam filter[keyword] string Search keyword in title, description, and content. Example: innovation
     * @bodyParam filter[date_range][from] string Filter articles from this date (Y-m-d format). Example: 2024-01-01
     * @bodyParam filter[date_range][to] string Filter articles to this date (Y-m-d format). Example: 2024-12-31
     * @bodyParam page integer Page number for pagination. Example: 1
     * @bodyParam per_page integer Number of items per page (1-100). Example: 15
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "externalId": "abc123",
     *       "source": "NewsAPI",
     *       "title": "Breaking News: Tech Innovation",
     *       "description": "A comprehensive look at the latest tech innovations",
     *       "content": "Full article content here...",
     *       "url": "https://example.com/article",
     *       "imageUrl": "https://example.com/image.jpg",
     *       "author": "John Doe",
     *       "category": "technology",
     *       "publishedAt": "2024-01-15T10:30:00.000Z",
     *       "contentHash": "hash123",
     *       "createdAt": "2024-01-15T10:30:00.000Z",
     *       "updatedAt": "2024-01-15T10:30:00.000Z"
     *     }
     *   ],
     *   "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 5,
     *     "per_page": 15,
     *     "to": 15,
     *     "total": 75
     *   }
     * }
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
