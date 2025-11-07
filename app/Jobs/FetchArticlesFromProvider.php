<?php

namespace App\Jobs;

use App\Contracts\NewsProviderInterface;
use App\Services\ArticleRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FetchArticlesFromProvider implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public int $backoff = 60;

    public int $timeout = 120;

    public function __construct(
        private readonly string $providerClass,
        private readonly array $params = []
    ) {}

    public function handle(ArticleRepository $repository): void
    {
        try {

            /**
             * @var NewsProviderInterface $provider
             */
            $provider = app($this->providerClass);

            if (! $provider instanceof NewsProviderInterface) {
                throw new \InvalidArgumentException(
                    'Provider must implement NewsProviderInterface'
                );
            }

            Log::info('Starting article fetch', [
                'provider' => $provider->getProviderName(),
                'params' => $this->params,
            ]);

            $articles = $provider->fetchArticles($this->params);

            if (empty($articles)) {
                Log::warning('No articles fetched', [
                    'provider' => $provider->getProviderName(),
                ]);

                return;
            }

            $stats = $repository->bulkStore($articles);

            Log::info('Article fetch completed', [
                'provider' => $provider->getProviderName(),
                'fetched' => count($articles),
                'stored' => $stats['stored'],
                'duplicates' => $stats['duplicates'],
                'errors' => $stats['errors'],
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to fetch articles', [
                'provider' => $this->providerClass,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e; // Re-throw to trigger retry mechanism
        }
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('Job failed permanently', [
            'provider' => $this->providerClass,
            'error' => $exception->getMessage(),
        ]);
    }
}
