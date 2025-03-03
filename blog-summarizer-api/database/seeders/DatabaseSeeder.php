<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Article;
use App\Infrastructure\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Article::factory()->create([
            'url' => 'https://example.com',
            'title' => 'Example Article',
            'summary' => 'This is an example article.',
        ]);
    }
}
