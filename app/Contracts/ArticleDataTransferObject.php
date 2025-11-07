<?php

namespace App\Contracts;

interface ArticleDataTransferObject
{
    public function getExternalId(): ?string;

    public function getSource(): string;

    public function getTitle(): string;

    public function getDescription(): ?string;

    public function getContent(): ?string;

    public function getUrl(): string;

    public function getImageUrl(): ?string;

    public function getAuthor(): ?string;

    public function getCategory(): ?string;

    public function getPublishedAt(): ?string;

    public function toArray(): array;

    public function getContentHash(): string;
}
