<?php

namespace App\Contracts;

/**
 * Interface for all news provider services
 *
 * This ensures all providers follow the same contract (Interface Segregation Principle)
 */
interface NewsProviderInterface
{
    /**
     * Fetch articles from the provider
     *
     * @param  array  $params  Query parameters (keyword, category, from, to, etc.)
     * @return array<ArticleDataTransferObject>
     */
    public function fetchArticles(array $params = []): array;

    /**
     * Get the provider name
     */
    public function getProviderName(): string;
}
