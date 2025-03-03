<?php
declare(strict_types=1);

namespace App\Infrastructure\Models;

use Database\Factories\Infrastructure\Models\ArticleFactory;
use Illuminate\Database\Eloquent\Concerns\HasUniqueStringIds;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use RuntimeException;

final class Article extends Model
{
    /** @use HasFactory<ArticleFactory> */
    use HasFactory, HasUniqueStringIds;

    protected $table = 'articles';
    protected $fillable = ['url', 'title', 'summary'];

    public function newUniqueId(): string
    {
        if (!is_string($this->url)) {
            throw new RuntimeException('Cannot generate Article ID; URL field is not a string');
        }

        return $this::generateUniqueId($this->url);
    }

    public static function generateUniqueId(string $url): string
    {
        return md5($url);
    }

    protected function isValidUniqueId($value): bool
    {
        return is_string($value) && Str::length($value) === 32;
    }
}
