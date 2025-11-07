<?php

namespace App\Services;

use App\Contracts\ArticleDataTransferObject;
use App\Models\Article;
use Illuminate\Support\Facades\Log;

/**
 * Repository for managing Article persistence
 *
 * Handles duplicate detection and bulk insertion.
 */
class ArticleRepository
{
    /**
     * Store a single article, preventing duplicates
     *
     * @return Article|null Returns null if duplicate detected
     */
    public function store(ArticleDataTransferObject $dto): ?Article
    {
        $data = $dto->toArray();

        try {
            // Check if article already exists by content hash
            $existing = Article::query()->where('content_hash', $data['content_hash'])->first();

            if ($existing) {
                Log::info('Duplicate article detected', [
                    'url' => $data['url'],
                    'hash' => $data['content_hash'],
                ]);

                return null;
            }

            return Article::create($data);

        } catch (\Exception $e) {
            Log::error('Failed to store article', [
                'error' => $e->getMessage(),
                'url' => $data['url'] ?? 'unknown',
            ]);

            return null;
        }
    }

    /**
     * Bulk store articles with duplicate detection
     *
     * @param  array<ArticleDataTransferObject>  $dtos
     * @return array{stored: int, duplicates: int, errors: int}
     */
    public function bulkStore(array $dtos): array
    {
        $stats = [
            'stored' => 0,
            'duplicates' => 0,
            'errors' => 0,
        ];

        if (empty($dtos)) {
            return $stats;
        }

        $contentHashes = array_map(fn ($dto) => $dto->getContentHash(), $dtos);
        $existingHashes = Article::query()->whereIn('content_hash', $contentHashes)
            ->pluck('content_hash')
            ->toArray();

        $existingHashesSet = array_flip($existingHashes);

        foreach ($dtos as $dto) {
            try {
                $hash = $dto->getContentHash();

                // Check if hash exists in our set
                if (isset($existingHashesSet[$hash])) {
                    $stats['duplicates']++;

                    continue;
                }

                // Try to create the article
                $article = Article::query()->create($dto->toArray());

                if ($article) {
                    $stats['stored']++;
                    $existingHashesSet[$hash] = true;
                }

            } catch (\Exception $e) {
                $stats['errors']++;
                Log::error('Failed to store article in bulk', [
                    'error' => $e->getMessage(),
                    'url' => $dto->getUrl(),
                ]);
            }
        }

        Log::info('Bulk article storage completed', $stats);

        return $stats;
    }

    public function exists(string $contentHash): bool
    {
        return Article::query()->where('content_hash', $contentHash)->exists();
    }

    public function existsByUrl(string $url): bool
    {
        return Article::query()->where('url', $url)->exists();
    }

    public function getCountBySource(string $source): int
    {
        return Article::query()->where('source', $source)->count();
    }

    public function deleteOlderThan(int $days): int
    {
        return Article::query()->where('published_at', '<', now()->subDays($days))->delete();
    }
}
