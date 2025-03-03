<?php
declare(strict_types=1);

namespace App\Application\Queries;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\Validation;
use Spatie\LaravelData\Data;

final class ListArticles extends Data
{
    public const int MaxLimit = 100;
    public const int DefaultLimit = 30;

    public function __construct(
        #[Validation\Before('now')]
        public readonly ?Carbon $before,
        #[Validation\Between(1, self::MaxLimit)]
        public readonly ?int    $limit = self::DefaultLimit,
    )
    {
    }

    public function getBefore(): Carbon
    {
        return $this->before ?? Carbon::now();
    }

    public function getLimit(): int
    {
        return max(1, min(self::MaxLimit, $this->limit));
    }
}
