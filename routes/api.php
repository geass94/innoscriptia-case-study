<?php

use App\Http\Controllers\Api\ArticleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
|
*/

Route::prefix('v1')->group(function () {
    // Article endpoints
    Route::get('/articles', [ArticleController::class, 'index'])->name('api.articles.index');
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('api.articles.show');

    // Filter options endpoints
    Route::get('/sources', [ArticleController::class, 'sources'])->name('api.sources');
    Route::get('/categories', [ArticleController::class, 'categories'])->name('api.categories');
    Route::get('/authors', [ArticleController::class, 'authors'])->name('api.authors');

    // User preferences endpoint
    Route::post('/articles/preferences', [ArticleController::class, 'preferences'])->name('api.articles.preferences');
});
