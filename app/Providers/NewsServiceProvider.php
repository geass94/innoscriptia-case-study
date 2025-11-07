<?php

namespace App\Providers;

use App\Services\Mappers\ArticleMapper;
use App\Services\NewsProviders\GuardianService;
use App\Services\NewsProviders\NewsApiService;
use App\Services\NewsProviders\NYTimesService;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ArticleMapper::class);

        $this->app->bind(NewsApiService::class, fn ($app) => new NewsApiService(
            mapper: $app->make(ArticleMapper::class),
            apiKey: config('services.newsapi.key', '')
        ));

        $this->app->bind(GuardianService::class, fn ($app) => new GuardianService(
            mapper: $app->make(ArticleMapper::class),
            apiKey: config('services.guardian.key', '')
        ));

        $this->app->bind(NYTimesService::class, fn ($app) => new NYTimesService(
            mapper: $app->make(ArticleMapper::class),
            apiKey: config('services.nytimes.key', '')
        ));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
