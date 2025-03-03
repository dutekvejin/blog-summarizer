<?php
declare(strict_types=1);

namespace App\Infrastructure\Http\Resources;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\Validation;
use Spatie\LaravelData\Data;

final class Article extends Data
{
    public function __construct(
        public readonly string $id,
        #[Validation\Url]
        public readonly string $url,
        public readonly string $title,
        public readonly string $summary,
        public readonly Carbon $createdAt,
    )
    {
    }

    public static function normalizers(): array
    {
        return array_merge(parent::normalizers(), [ArticleNormalizer::class]);
    }
}
