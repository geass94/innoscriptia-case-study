<?php

namespace App\Services\NewsProviders;

use App\Contracts\NewsProviderInterface;
use App\Enums\NewsProviderParam;
use App\Enums\NYTimesApiEndpoint;
use App\Enums\NYTimesApiParam;
use App\Enums\NYTimesApiResponse;
use App\Services\Mappers\ArticleMapper;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service for fetching articles from The New York Times
 *
 * API Documentation: https://developer.nytimes.com/docs/articlesearch-product/1/overview
 */
class NYTimesService implements NewsProviderInterface
{
    private const BASE_URL = 'https://api.nytimes.com/svc';

    public function __construct(
        private readonly ArticleMapper $mapper,
        private readonly ?string $apiKey = null
    ) {}

    public function getProviderName(): string
    {
        return 'NY Times';
    }

    /**
     * Fetch articles from NY Times
     *
     * @param  array  $params  {
     *
     * @type string $keyword Search keyword
     * @type string $category News desk value (Foreign, Sports, Business, etc.)
     * @type string $from From date (YYYYMMDD)
     * @type string $to To date (YYYYMMDD)
     * @type int $pageSize Page number (10 results per page)
     *           }
     */
    public function fetchArticles(array $params = []): array
    {
        if (! $this->apiKey) {
            Log::warning('NY Times API key not configured');

            return [];
        }

        try {
            $queryParams = [
                NYTimesApiParam::API_KEY->value => $this->apiKey,
            ];

            if (isset($params[NewsProviderParam::KEYWORD->value])) {
                $queryParams[NYTimesApiParam::QUERY->value] = $params[NewsProviderParam::KEYWORD->value];
            }

            if (isset($params[NewsProviderParam::CATEGORY->value])) {
                $queryParams[NYTimesApiParam::FILTER_QUERY->value] = 'news_desk:("'.$params[NewsProviderParam::CATEGORY->value].'")';
            }

            if (isset($params[NewsProviderParam::FROM->value])) {
                // Convert YYYY-MM-DD to YYYYMMDD
                $queryParams[NYTimesApiParam::BEGIN_DATE->value] = str_replace('-', '', $params[NewsProviderParam::FROM->value]);
            }

            if (isset($params[NewsProviderParam::TO->value])) {
                // Convert YYYY-MM-DD to YYYYMMDD
                $queryParams[NYTimesApiParam::END_DATE->value] = str_replace('-', '', $params[NewsProviderParam::TO->value]);
            }

            // NY Times returns 10 results per page
            $page = $params[NewsProviderParam::PAGE->value] ?? 0;
            $queryParams[NYTimesApiParam::PAGE->value] = $page;

            $response = Http::timeout(30)
                ->get(self::BASE_URL.NYTimesApiEndpoint::ARTICLE_SEARCH->value, $queryParams);

            if (! $response->successful()) {
                Log::error('NY Times API request failed', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);

                return [];
            }

            $data = $response->json();

            if ($data[NYTimesApiResponse::FIELD_STATUS->value] !== NYTimesApiResponse::STATUS_OK->value
                || ! isset($data[NYTimesApiResponse::FIELD_RESPONSE->value][NYTimesApiResponse::FIELD_DOCS->value])) {
                Log::warning('NY Times API returned unexpected response', ['data' => $data]);

                return [];
            }

            return $this->mapper->mapNYTimesArticles(
                $data[NYTimesApiResponse::FIELD_RESPONSE->value][NYTimesApiResponse::FIELD_DOCS->value]
            );

        } catch (\Exception $e) {
            Log::error('NY Times API fetch failed', [
                'error' => $e->getMessage(),
                'params' => $params,
            ]);

            return [];
        }
    }
}
