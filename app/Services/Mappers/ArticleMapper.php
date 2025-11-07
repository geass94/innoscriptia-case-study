<?php

namespace App\Services\Mappers;

use App\Contracts\ArticleDataTransferObject;
use App\DTOs\GuardianArticleDTO;
use App\DTOs\NewsApiArticleDTO;
use App\DTOs\NYTimesArticleDTO;

class ArticleMapper
{
    public function mapNewsApiArticle(array $article, ?string $category = null): ArticleDataTransferObject
    {
        if ($category) {
            $article['category'] = $category;
        }

        return NewsApiArticleDTO::fromApiResponse($article);
    }

    public function mapNewsApiArticles(array $articles, ?string $category = null): array
    {
        return array_map(
            fn ($article) => $this->mapNewsApiArticle($article, $category),
            $articles
        );
    }

    public function mapGuardianArticle(array $article): ArticleDataTransferObject
    {
        return GuardianArticleDTO::fromApiResponse($article);
    }

    public function mapGuardianArticles(array $articles): array
    {
        return array_map(
            fn ($article) => $this->mapGuardianArticle($article),
            $articles
        );
    }

    public function mapNYTimesArticle(array $article): ArticleDataTransferObject
    {
        return NYTimesArticleDTO::fromApiResponse($article);
    }

    public function mapNYTimesArticles(array $articles): array
    {
        return array_map(
            fn ($article) => $this->mapNYTimesArticle($article),
            $articles
        );
    }
}
