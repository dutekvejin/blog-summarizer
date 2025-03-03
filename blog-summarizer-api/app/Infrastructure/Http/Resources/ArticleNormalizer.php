<?php
declare(strict_types=1);

namespace App\Infrastructure\Http\Resources;

use App\Domain;
use Spatie\LaravelData\Normalizers\Normalizer;

final readonly class ArticleNormalizer implements Normalizer
{
    public function normalize(mixed $value): ?array
    {
        return $value instanceof Domain\Article ? [
            'id' => $value->getId(),
            'url' => $value->getUrl(),
            'title' => $value->getTitle(),
            'summary' => $value->getSummary(),
            'createdAt' => $value->getCreatedAt(),
        ] : null;
    }
}
