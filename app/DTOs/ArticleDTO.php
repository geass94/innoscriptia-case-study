<?php

namespace App\DTOs;

use App\Contracts\ArticleDataTransferObject;
use App\Models\Article;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class ArticleDTO extends Data implements ArticleDataTransferObject
{
    public function __construct(
        public ?int $id = null,
        public ?string $externalId = null,
        public ?string $source = null,
        public ?string $title = null,
        public ?string $description = null,
        public ?string $content = null,
        public ?string $url = null,
        public ?string $imageUrl = null,
        public ?string $author = null,
        public ?string $category = null,
        public ?string $publishedAt = null,
        #[Computed]
        public ?string $contentHash = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {
        if ($this->title && $this->url) {
            $this->contentHash = $this->contentHash ?? Article::generateContentHash(
                $this->title,
                $this->url,
                $this->publishedAt
            );
        }
    }

    public static function fromModel(Article $article): self
    {
        return new self(
            id: $article->id,
            externalId: $article->external_id,
            source: $article->source,
            title: $article->title,
            description: $article->description,
            content: $article->content,
            url: $article->url,
            imageUrl: $article->image_url,
            author: $article->author,
            category: $article->category,
            publishedAt: $article->published_at?->toISOString(),
            contentHash: $article->content_hash,
            createdAt: $article->created_at?->toISOString(),
            updatedAt: $article->updated_at?->toISOString(),
        );
    }

    public static function fromDTO(ArticleDataTransferObject $dto): self
    {
        $instance = new self(
            externalId: $dto->getExternalId(),
            source: $dto->getSource(),
            title: $dto->getTitle(),
            description: $dto->getDescription(),
            content: $dto->getContent(),
            url: $dto->getUrl(),
            imageUrl: $dto->getImageUrl(),
            author: $dto->getAuthor(),
            category: $dto->getCategory(),
            publishedAt: $dto->getPublishedAt(),
        );

        return $instance;
    }

    // Interface implementation methods
    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function getSource(): string
    {
        return $this->source ?? '';
    }

    public function getTitle(): string
    {
        return $this->title ?? '';
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
        return $this->url ?? '';
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
        return $this->contentHash ?? '';
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
