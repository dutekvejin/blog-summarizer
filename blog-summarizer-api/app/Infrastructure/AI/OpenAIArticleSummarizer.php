<?php
declare(strict_types=1);

namespace App\Infrastructure\AI;

use App\Domain\ArticleSummarizer;
use OpenAI\Laravel\Facades\OpenAI;

final readonly class OpenAIArticleSummarizer implements ArticleSummarizer
{
    private function getInstructions(): string
    {
        return 'You are an AI designed to summarize blog posts in one concise sentence. If the text includes an author, mention them in the summary. Ensure that the summary does not start with phrases like "In this blog post" or "This blog post." If the provided content does not resemble a blog post, simply state `Provided URL is not an article` rather than summarizing it. Avoid subjective opinions or adding new information!';
    }

    public function getSummary(string $content): string
    {
        $result = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => $this->getInstructions()],
                ['role' => 'user', 'content' => $content],
            ],
        ]);

        return $result->choices[0]->message->content;
    }
}
