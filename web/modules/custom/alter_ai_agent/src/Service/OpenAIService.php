<?php

namespace Drupal\alter_ai_agent\Service;

use OpenAI\Client;

class OpenAIService {

  protected $client;

  public function __construct() {
    $this->client = new Client(getenv('OPENAI_API_KEY'));
  }

  public function generateText(string $prompt): string {
    $response = $this->client->completions()->create([
      'model' => 'gpt-4',
      'prompt' => $prompt,
      'max_tokens' => 500,
    ]);

    return $response['choices'][0]['text'] ?? '';
  }
}
