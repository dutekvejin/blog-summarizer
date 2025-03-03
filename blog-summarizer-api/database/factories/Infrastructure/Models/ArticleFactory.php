<?php
declare(strict_types=1);

namespace Database\Factories\Infrastructure\Models;

use App\Infrastructure\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
final class ArticleFactory extends Factory
{

    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [];
    }
}
