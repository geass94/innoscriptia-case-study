<?php

namespace App\Jobs;

use App\Services\NewsProviders\GuardianService;
use App\Services\NewsProviders\NewsApiService;
use App\Services\NewsProviders\NYTimesService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FetchArticlesFromAllProviders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly array $params = []
    ) {}

    public function handle(): void
    {
        Log::info('Dispatching article fetch jobs for all providers', [
            'params' => $this->params,
        ]);

        $providers = [
            NewsApiService::class,
            GuardianService::class,
            NYTimesService::class,
        ];

        foreach ($providers as $provider) {
            FetchArticlesFromProvider::dispatchSync($provider, $this->params);
        }

        Log::info('All provider jobs dispatched', [
            'count' => count($providers),
        ]);
    }
}
