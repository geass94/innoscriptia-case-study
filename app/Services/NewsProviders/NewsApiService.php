<?php

namespace App\Services\NewsProviders;

use App\Contracts\NewsProviderInterface;
use App\Enums\NewsApiEndpoint;
use App\Enums\NewsApiParam;
use App\Enums\NewsApiResponse;
use App\Enums\NewsProviderParam;
use App\Services\Mappers\ArticleMapper;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service for fetching articles from NewsAPI
 *
 * API Documentation: https://newsapi.org/docs
 */
class NewsApiService implements NewsProviderInterface
{
    private const BASE_URL = 'https://newsapi.org/v2';

    public function __construct(
        private readonly ArticleMapper $mapper,
        private readonly ?string $apiKey = null
    ) {}

    public function getProviderName(): string
    {
        return 'NewsAPI';
    }

    /**
     * Fetch articles from NewsAPI
     *
     * @param  array  $params  {
     *
     * @type string $keyword Search keyword
     * @type string $category Category (business, entertainment, general, health, science, sports, technology)
     * @type string $from From date (YYYY-MM-DD)
     * @type string $to To date (YYYY-MM-DD)
     * @type int $pageSize Number of results (max 100)
     *           }
     */
    public function fetchArticles(array $params = []): array
    {
        if (! $this->apiKey) {
            Log::warning('NewsAPI key not configured');

            return [];
        }

        try {
            $endpoint = isset($params[NewsProviderParam::KEYWORD->value])
                ? NewsApiEndpoint::EVERYTHING->value
                : NewsApiEndpoint::TOP_HEADLINES->value;

            $queryParams = [
                NewsApiParam::API_KEY->value => $this->apiKey,
                NewsApiParam::PAGE_SIZE->value => $params[NewsProviderParam::PAGE_SIZE->value] ?? 50,
            ];

            if (isset($params[NewsProviderParam::KEYWORD->value])) {
                $queryParams[NewsApiParam::QUERY->value] = $params[NewsProviderParam::KEYWORD->value];
            }

            // Category parameter only works with /top-headlines
            if ($endpoint === NewsApiEndpoint::TOP_HEADLINES->value) {
                if (isset($params[NewsProviderParam::CATEGORY->value])) {
                    $queryParams[NewsApiParam::CATEGORY->value] = $params[NewsProviderParam::CATEGORY->value];
                } else {
                    // For top-headlines, we need to specify country if no category
                    $queryParams[NewsApiParam::COUNTRY->value] = 'us';
                }
            }

            if (isset($params[NewsProviderParam::FROM->value])) {
                $queryParams[NewsApiParam::FROM->value] = $params[NewsProviderParam::FROM->value];
            }

            if (isset($params[NewsProviderParam::TO->value])) {
                $queryParams[NewsApiParam::TO->value] = $params[NewsProviderParam::TO->value];
            }

            $response = Http::timeout(30)
                ->get(self::BASE_URL.$endpoint, $queryParams);

            if (! $response->successful()) {
                Log::error('NewsAPI request failed', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);

                return [];
            }

            $data = $response->json();

            if ($data[NewsApiResponse::FIELD_STATUS->value] !== NewsApiResponse::STATUS_OK->value
                || ! isset($data[NewsApiResponse::FIELD_ARTICLES->value])) {
                Log::warning('NewsAPI returned unexpected response', ['data' => $data]);

                return [];
            }

            return $this->mapper->mapNewsApiArticles(
                $data[NewsApiResponse::FIELD_ARTICLES->value],
                $params[NewsProviderParam::CATEGORY->value] ?? null
            );

        } catch (\Exception $e) {
            Log::error('NewsAPI fetch failed', [
                'error' => $e->getMessage(),
                'params' => $params,
            ]);

            return [];
        }
    }
}
