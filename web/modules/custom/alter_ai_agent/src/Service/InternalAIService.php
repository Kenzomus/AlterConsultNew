<?php

namespace Drupal\alter_ai_agent\Service;

use Drupal\alter_ai_agent\Service\OpenAIService;

class InternalAIService {

  protected $openAI;

  public function __construct(OpenAIService $openAI) {
    $this->openAI = $openAI;
  }

  /**
   * Process client data, generate PRD draft.
   */
  public function processClient(array $client) {
    $prompt = "Create a project requirements document (PRD) for the following client project details:\n" . $client['project_details'];
    $prd = $this->openAI->generateText($prompt);

    $conn = \Drupal::database();
    $conn->insert('alter_ai_prd')->fields([
      'client_id' => $client['id'] ?? NULL,
      'prd_content' => $prd,
      'status' => 'Draft',
      'created_at' => date('Y-m-d H:i:s'),
    ])->execute();
  }

  // Additional methods for analytics, lead tracking, insights can be added here.
}
