<?php
declare(strict_types=1);

namespace App\Application\Services;

use Dom\HTMLDocument;

final readonly class ArticleParser
{
    private const int Options = LIBXML_HTML_NOIMPLIED | LIBXML_NOERROR;
    private HTMLDocument $document;

    public function __construct(string $content)
    {
        $this->document = HTMLDocument::createFromString($content, self::Options);
    }

    public function getTitle(): string
    {
        return $this->document->querySelector('title')?->textContent ?: '';
    }

    public function getContent(): string
    {
        if (!$article = $this->document->querySelector('article:first-child')) {
            return $this->document->querySelector('body')?->textContent ?: '';
        }

        // todo Remove all unwanted elements...

        // Remove all <figure> elements, just because we can :)
        foreach ($article->querySelectorAll('figure') as $figure) {
            $figure->parentNode->removeChild($figure);
        }

        return $article->textContent ?: '';
    }
}
