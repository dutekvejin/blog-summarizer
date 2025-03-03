<?php
declare(strict_types=1);

namespace App\Domain;

interface ArticleSummarizer
{
    public function getSummary(string $content): string;
}
