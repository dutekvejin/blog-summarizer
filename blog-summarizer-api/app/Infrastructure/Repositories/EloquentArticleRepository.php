<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Application\Queries\ListArticles;
use App\Domain\Article;
use App\Domain\ArticleRepository;
use App\Infrastructure\Models;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Enumerable;

final readonly class EloquentArticleRepository implements ArticleRepository
{
    /** @var Closure<Models\Article, Article> */
    private Closure $mapper;

    public function __construct()
    {
        $this->mapper = fn(Models\Article $article) => new Article(
            $article->id,
            $article->url,
            $article->title,
            $article->summary,
            $article->created_at,
        );
    }

    public function create(string $url, string $title, string $summary): Article
    {
        return ($this->mapper)(
            Models\Article::create([
                'url' => $url, 'title' => $title, 'summary' => $summary,
            ])
        );
    }

    public function findById(string $id): ?Article
    {
        if ($article = Models\Article::find($id)) {
            return ($this->mapper)($article);
        }

        return null;
    }

    public function findByUrl(string $url): ?Article
    {
        return $this->findById(Models\Article::generateUniqueId($url));
    }

    public function findCreatedBefore(Carbon $before, int $limit = ListArticles::DefaultLimit): Enumerable
    {
        return Models\Article::query()
            ->where('created_at', '<', $before)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get()
            ->map($this->mapper);
    }
}
