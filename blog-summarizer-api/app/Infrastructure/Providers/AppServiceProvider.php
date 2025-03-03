<?php
declare(strict_types=1);

namespace App\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Domain\ArticleRepository::class,
            \App\Infrastructure\Repositories\EloquentArticleRepository::class
        );

        $this->app->bind(
            \App\Domain\ArticleSummarizer::class,
            \App\Infrastructure\AI\OpenAIArticleSummarizer::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
