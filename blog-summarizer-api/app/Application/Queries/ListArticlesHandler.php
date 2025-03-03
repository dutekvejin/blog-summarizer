<?php
declare(strict_types=1);

namespace App\Application\Queries;

use App\Domain\Article;
use App\Domain\ArticleRepository;
use Illuminate\Support\Enumerable;

final readonly class ListArticlesHandler
{
    public function __construct(
        private ArticleRepository $articleRepository
    )
    {
    }

    /**
     * @return Enumerable<Article>
     */
    public function handle(ListArticles $listArticles): Enumerable
    {
        return $this->articleRepository->findCreatedBefore(
            $listArticles->getBefore(), $listArticles->getLimit()
        );
    }
}
