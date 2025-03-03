<?php
declare(strict_types=1);

namespace Tests\Unit\App\Application\Services;

use App\Application\Services\ArticleParser;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ArticleParser::class)]
final class ArticleParserTest extends TestCase
{
    public function testGetTitle(): void
    {
        $expectedTitle = 'Test Title';

        $content = "<head><title>$expectedTitle</title></head>";
        $articleParser = new ArticleParser($content);

        $this->assertSame($expectedTitle, $articleParser->getTitle());
    }

    public function testGetContentFromArticleElement(): void
    {
        $expectedContent = 'Test Article Content';

        $content = "<body><article>$expectedContent</article><span>Should not be parsed!</span></body>";
        $articleParser = new ArticleParser($content);

        $this->assertSame($expectedContent, $articleParser->getContent());
    }

    public function testGetContentFromBodyWhenNoArticleElement(): void
    {
        $expectedContent = 'Test Document Content';

        $content = "<body><span>$expectedContent</span></body>";
        $articleParser = new ArticleParser($content);

        $this->assertSame($expectedContent, $articleParser->getContent());
    }

    public function testGetContentRemovesFigureElement()
    {
        $expectedContent = 'Test Article Content';

        $content = "<body><article>$expectedContent<figure>Should not be parsed!</figure></article></body>";
        $articleParser = new ArticleParser($content);

        $this->assertSame($expectedContent, $articleParser->getContent());
    }
}
