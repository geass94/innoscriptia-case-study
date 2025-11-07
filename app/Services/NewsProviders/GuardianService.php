<?php

namespace App\Services\NewsProviders;

use App\Contracts\NewsProviderInterface;
use App\Enums\GuardianApiEndpoint;
use App\Enums\GuardianApiParam;
use App\Enums\GuardianApiResponse;
use App\Enums\GuardianShowFields;
use App\Enums\NewsProviderParam;
use App\Services\Mappers\ArticleMapper;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service for fetching articles from The Guardian
 *
 * API Documentation: https://open-platform.theguardian.com/documentation/
 */
class GuardianService implements NewsProviderInterface
{
    private const BASE_URL = 'https://content.guardianapis.com';

    public function __construct(
        private readonly ArticleMapper $mapper,
        private readonly ?string $apiKey = null
    ) {}

    public function getProviderName(): string
    {
        return 'The Guardian';
    }

    /**
     * Fetch articles from The Guardian
     *
     * @param  array  $params  {
     *
     * @type string $keyword Search keyword
     * @type string $category Section (world, politics, business, etc.)
     * @type string $from From date (YYYY-MM-DD)
     * @type string $to To date (YYYY-MM-DD)
     * @type int $pageSize Number of results (max 50)
     *           }
     */
    public function fetchArticles(array $params = []): array
    {
        if (! $this->apiKey) {
            Log::warning('Guardian API key not configured');

            return [];
        }

        try {
            $queryParams = [
                GuardianApiParam::API_KEY->value => $this->apiKey,
                GuardianApiParam::PAGE_SIZE->value => $params[NewsProviderParam::PAGE_SIZE->value] ?? 50,
                GuardianApiParam::SHOW_FIELDS->value => GuardianShowFields::all(),
            ];

            if (isset($params[NewsProviderParam::KEYWORD->value])) {
                $queryParams[GuardianApiParam::QUERY->value] = $params[NewsProviderParam::KEYWORD->value];
            }

            if (isset($params[NewsProviderParam::CATEGORY->value])) {
                $queryParams[GuardianApiParam::SECTION->value] = $params[NewsProviderParam::CATEGORY->value];
            }

            if (isset($params[NewsProviderParam::FROM->value])) {
                $queryParams[GuardianApiParam::FROM_DATE->value] = $params[NewsProviderParam::FROM->value];
            }

            if (isset($params[NewsProviderParam::TO->value])) {
                $queryParams[GuardianApiParam::TO_DATE->value] = $params[NewsProviderParam::TO->value];
            }

            $response = Http::timeout(30)
                ->get(self::BASE_URL.GuardianApiEndpoint::SEARCH->value, $queryParams);

            if (! $response->successful()) {
                Log::error('Guardian API request failed', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);

                return [];
            }

            $data = $response->json();

            if ($data[GuardianApiResponse::FIELD_RESPONSE->value][GuardianApiResponse::FIELD_STATUS->value] !== GuardianApiResponse::STATUS_OK->value
                || ! isset($data[GuardianApiResponse::FIELD_RESPONSE->value][GuardianApiResponse::FIELD_RESULTS->value])) {
                Log::warning('Guardian API returned unexpected response', ['data' => $data]);

                return [];
            }

            return $this->mapper->mapGuardianArticles(
                $data[GuardianApiResponse::FIELD_RESPONSE->value][GuardianApiResponse::FIELD_RESULTS->value]
            );

        } catch (\Exception $e) {
            Log::error('Guardian API fetch failed', [
                'error' => $e->getMessage(),
                'params' => $params,
            ]);

            return [];
        }
    }
}
