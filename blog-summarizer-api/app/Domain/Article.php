<?php
declare(strict_types=1);

namespace App\Domain;

use Carbon\Carbon;

final readonly class Article
{
    public function __construct(
        private string $id,
        private string $url,
        private string $title,
        private string $summary,
        private Carbon $createdAt,
    )
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

}
