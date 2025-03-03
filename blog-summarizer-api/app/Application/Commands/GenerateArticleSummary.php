<?php
declare(strict_types=1);

namespace App\Application\Commands;

use Spatie\LaravelData\Attributes\Validation;
use Spatie\LaravelData\Data;

final class GenerateArticleSummary extends Data
{
    public function __construct(
        #[Validation\Url]
        public readonly string $url
    )
    {
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
