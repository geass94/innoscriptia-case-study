<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->nullable()->index();
            $table->string('source'); // NewsAPI, TheGuardian, NYTimes
            $table->string('title');
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('url')->unique();
            $table->string('image_url')->nullable();
            $table->string('author')->nullable();
            $table->string('category')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->string('content_hash', 64)->unique(); // SHA256 hash for duplicate detection
            $table->timestamps();

            // Indexes for filtering and searching
            $table->index(['source', 'published_at']);
            $table->index(['category', 'published_at']);
            $table->index('published_at');
        });

        // Add fulltext index only for MySQL/MariaDB (not supported in SQLite)
        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            Schema::table('articles', function (Blueprint $table) {
                $table->fullText(['title', 'description', 'content']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
