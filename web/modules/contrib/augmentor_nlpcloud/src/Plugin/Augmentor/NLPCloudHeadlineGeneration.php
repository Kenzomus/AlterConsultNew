<?php

namespace Drupal\augmentor_nlpcloud\Plugin\Augmentor;

use Drupal\augmentor_nlpcloud\NPLCloudBase;

/**
 * NLP Cloud Headline Generation augmentor plugin implementation.
 *
 * @Augmentor(
 *   id = "augmentor_nlpcloud_headline_generation",
 *   label = @Translation("NLP Cloud Headline Generation"),
 *   description = @Translation("Send a text, and get a very short summary
 *   suited for headlines, in many languages We are using Michau's T5 Base EN
 *   Generate Headline with PyTorch and Hugging Face transformers.
 *   You can also use your own model."),
 * )
 */
class NLPCloudHeadlineGeneration extends NPLCloudBase {

  /**
   * Default NLP Cloud model for headline generation.
   */
  const NLP_CLOUD_MODEL = 't5-base-en-generate-headline';

  /**
   * Default GPU/CPU status: TRUE (use GPU) / FALSE (use CPU).
   */
  const NLP_CLOUD_GPU = FALSE;

  /**
   * Generates a very short summary out of the provided input text.
   *
   * @param string $text
   *   The block of text that you want to summarize. 8192 tokens maximum.
   *
   * @return array
   *   The summary of your text.
   */
  public function execute(string $text): array {
    try {
      $language = trim($this->configuration['language']);
      $client = $this->getClient(self::NLP_CLOUD_MODEL, self::NLP_CLOUD_GPU, $language);
      $result = $client->summarization($text);
      return ['default' => $result->summary_text];
    }
    catch (\Throwable $error) {
      $this->logger->error('NLP Cloud Headline Generation error: %message.', [
        '%message' => $error->getMessage(),
      ]);
      return [
        '_errors' => $this->t('Error during the NLP Cloud headline generation, please check the logs for more information.')->render(),
      ];
    }
  }

}
