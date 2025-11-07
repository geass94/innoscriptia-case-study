<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withSchedule(function (Schedule $schedule): void {
        // Fetch articles from all news providers daily at midnight
        // Fetches articles from the previous day
        $schedule->command('articles:fetch', [
            '--from' => now()->subDay()->format('Y-m-d'),
            '--to' => now()->subDay()->format('Y-m-d'),
        ])
            ->daily()
            ->at('00:00')
            ->timezone('UTC')
            ->description('Fetch daily news articles from all providers');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
