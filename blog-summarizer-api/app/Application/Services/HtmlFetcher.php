<?php
declare(strict_types=1);

namespace App\Application\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

final readonly class HtmlFetcher
{
    public function fetch(string $url): HtmlFetcherResult
    {
        try {
            return HtmlFetcherResult::createSuccess($this->getContent($url));
        } catch (GuzzleException $e) {
            return HtmlFetcherResult::createError($e->getMessage());
        }
    }

    /**
     * @throws GuzzleException
     */
    private function getContent(string $url): string
    {
        return (string)new Client()->get($url)->getBody();
    }
}
