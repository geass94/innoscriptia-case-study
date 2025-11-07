<?php

namespace App\DTOs;

use App\Contracts\ArticleDataTransferObject;
use App\Models\Article;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

/**
 * DTO for NewsAPI articles
 *
 * NewsAPI response structure:
 * {
 *   "source": {"id": "abc-news", "name": "ABC News"},
 *   "author": "John Doe",
 *   "title": "Article Title",
 *   "description": "Article description",
 *   "url": "https://...",
 *   "urlToImage": "https://...",
 *   "publishedAt": "2025-01-01T00:00:00Z",
 *   "content": "Article content..."
 * }
 */
class NewsApiArticleDTO extends Data implements ArticleDataTransferObject
{
    public function __construct(
        public ?string $externalId,
        public string $source,
        public string $title,
        public ?string $description,
        public ?string $content,
        public string $url,
        public ?string $imageUrl,
        public ?string $author,
        public ?string $category,
        public ?string $publishedAt,
        #[Computed]
        public ?string $contentHash = null,
    ) {
        $this->contentHash = $this->contentHash ?? Article::generateContentHash(
            $this->title,
            $this->url,
            $this->publishedAt
        );
    }

    public static function fromApiResponse(array $data): self
    {
        return new self(
            externalId: $data['source']['id'] ?? null,
            source: 'NewsAPI',
            title: $data['title'] ?? 'Untitled',
            description: $data['description'] ?? null,
            content: $data['content'] ?? null,
            url: $data['url'],
            imageUrl: $data['urlToImage'] ?? null,
            author: $data['author'] ?? null,
            category: $data['category'] ?? null,
            publishedAt: $data['publishedAt'] ?? null,
        );
    }

    // Interface implementation methods
    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function getPublishedAt(): ?string
    {
        return $this->publishedAt;
    }

    public function getContentHash(): string
    {
        return $this->contentHash;
    }

    /**
     * Override toArray to provide snake_case keys for database storage
     */
    public function toArray(): array
    {
        return [
            'external_id' => $this->externalId,
            'source' => $this->source,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'url' => $this->url,
            'image_url' => $this->imageUrl,
            'author' => $this->author,
            'category' => $this->category,
            'published_at' => $this->publishedAt,
            'content_hash' => $this->contentHash,
        ];
    }
}
