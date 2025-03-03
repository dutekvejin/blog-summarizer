<?php
declare(strict_types=1);

namespace App\Application\Services;

final readonly class HtmlFetcherResult
{
    private function __construct(
        private ?string $content = null,
        private ?string $errorMessage = null,
    )
    {
    }

    public static function createSuccess(string $content): self
    {
        return new self($content);
    }

    public static function createError(string $errorMessage): self
    {
        return new self(null, $errorMessage);
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    public function hasError(): bool
    {
        return $this->errorMessage !== null;
    }
}
