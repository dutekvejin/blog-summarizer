<?php
declare(strict_types=1);

namespace App\Application\Commands;

use App\Application\Services\ArticleParser;
use App\Application\Services\HtmlFetcher;
use App\Domain\Article;
use App\Domain\ArticleRepository;
use App\Domain\ArticleSummarizer;
use DomainException;

final readonly class GenerateArticleSummaryHandler
{
    public function __construct(
        private ArticleRepository $articleRepository,
        private HtmlFetcher       $htmlFetcher,
        private ArticleSummarizer $articleSummarizer,
    )
    {
    }

    public function handle(GenerateArticleSummary $generateArticleSummary): Article
    {
        $url = $generateArticleSummary->getUrl();

        if ($article = $this->articleRepository->findByUrl($url)) {
            return $article;
        }

        $htmlFetcherResult = $this->htmlFetcher->fetch($url);
        if ($htmlFetcherResult->hasError()) {
            throw new DomainException($htmlFetcherResult->getErrorMessage());
        }

        $articleParser = new ArticleParser($htmlFetcherResult->getContent());

        $title = $articleParser->getTitle();
        $summary = $this->articleSummarizer->getSummary(
            $articleParser->getContent()
        );

        return $this->articleRepository->create($url, $title, $summary);
    }
}
