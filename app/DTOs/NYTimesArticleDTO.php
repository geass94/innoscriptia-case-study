<?php

namespace App\DTOs;

use App\Contracts\ArticleDataTransferObject;
use App\Models\Article;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

/**
 * DTO for New York Times articles
 *
 * NYTimes API response structure:
 * {
 *   "uri": "nyt://article/...",
 *   "url": "https://...",
 *   "headline": {
 *     "main": "Article Title",
 *     "print_headline": "Print Title"
 *   },
 *   "abstract": "Article description",
 *   "lead_paragraph": "First paragraph...",
 *   "byline": {
 *     "original": "By John Doe"
 *   },
 *   "section_name": "World",
 *   "pub_date": "2025-01-01T00:00:00+0000",
 *   "multimedia": [
 *     {"url": "images/...", "type": "image"}
 *   ]
 * }
 */
class NYTimesArticleDTO extends Data implements ArticleDataTransferObject
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
        // Extract title
        $title = 'Untitled';
        if (isset($data['headline']['main'])) {
            $title = $data['headline']['main'];
        } elseif (isset($data['headline']) && is_string($data['headline'])) {
            $title = $data['headline'];
        }

        // Extract image URL
        $imageUrl = null;
        if (isset($data['multimedia']) && is_array($data['multimedia']) && count($data['multimedia']) > 0) {
            // Re-index array to ensure we can access index 0
            $multimedia = array_values($data['multimedia']);
            $firstImage = $multimedia[0];
            if (isset($firstImage['url'])) {
                $url = $firstImage['url'];
                $imageUrl = str_starts_with($url, 'http')
                    ? $url
                    : 'https://www.nytimes.com/'.ltrim($url, '/');
            }
        }

        // Extract author
        $author = null;
        if (isset($data['byline']['original'])) {
            $author = preg_replace('/^By\s+/i', '', $data['byline']['original']);
        } elseif (isset($data['byline']) && is_string($data['byline'])) {
            $author = preg_replace('/^By\s+/i', '', $data['byline']);
        }

        return new self(
            externalId: $data['uri'] ?? $data['_id'] ?? null,
            source: 'NY Times',
            title: $title,
            description: $data['abstract'] ?? $data['snippet'] ?? null,
            content: $data['lead_paragraph'] ?? null,
            url: $data['web_url'] ?? $data['url'] ?? '',
            imageUrl: $imageUrl,
            author: $author,
            category: $data['section_name'] ?? $data['news_desk'] ?? null,
            publishedAt: $data['pub_date'] ?? $data['published_date'] ?? null,
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
