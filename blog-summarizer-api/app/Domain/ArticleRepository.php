<?php
declare(strict_types=1);

namespace App\Domain;

use App\Application\Queries\ListArticles;
use Carbon\Carbon;
use Illuminate\Support\Enumerable;

interface ArticleRepository
{
    public function create(string $url, string $title, string $summary): Article;

    public function findById(string $id): ?Article;

    public function findByUrl(string $url): ?Article;

    /**
     * @return Enumerable<Article>
     */
    public function findCreatedBefore(Carbon $before, int $limit = ListArticles::DefaultLimit): Enumerable;
}
