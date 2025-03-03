<?php
declare(strict_types=1);

namespace App\Infrastructure\Http\Controllers\Api;

use App\Application\Commands\GenerateArticleSummary;
use App\Application\Commands\GenerateArticleSummaryHandler;
use App\Application\Queries\ListArticles;
use App\Application\Queries\ListArticlesHandler;
use App\Infrastructure\Http\Resources;
use Illuminate\Support\Enumerable;
use Spatie\RouteDiscovery\Attributes\Route;

final readonly class ArticlesController
{
    #[Route('get', '/')]
    public function listArticles(
        ListArticles        $listArticles,
        ListArticlesHandler $listArticlesHandler
    ): Enumerable
    {
        return Resources\Article::collect(
            $listArticlesHandler->handle($listArticles)
        );
    }

    #[Route('post', '/')]
    public function generateArticleSummary(
        GenerateArticleSummary        $generateArticleSummary,
        GenerateArticleSummaryHandler $generateArticleSummaryHandler
    ): Resources\Article
    {
        return Resources\Article::from(
            $generateArticleSummaryHandler->handle($generateArticleSummary)
        );
    }
}
