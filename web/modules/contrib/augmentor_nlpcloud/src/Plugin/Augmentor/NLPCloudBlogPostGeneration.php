<?php

namespace Drupal\augmentor_nlpcloud\Plugin\Augmentor;

use Drupal\augmentor_nlpcloud\NPLCloudBase;

/**
 * NLP Cloud Blog Post Generation augmentor plugin implementation.
 *
 * @Augmentor(
 *   id = "augmentor_nlpcloud_blog_post_generation",
 *   label = @Translation("NLP Cloud Blog Post Generation"),
 *   description = @Translation("Create a whole blog article out of a simple
 *   title, from 800 to 1500 words, and containing basic HTML tags, in many
 *   languages. We are using GPT-J and GPT-NeoX 20B with PyTorch and Hugging
 *   Face transformers . They are powerful open-source equivalents of
 *   OpenAI GPT-3. You can also use your own model."),
 * )
 */
class NLPCloudBlogPostGeneration extends NPLCloudBase {

  /**
   * Default NLP Cloud model for blog post generation.
   */
  const NLP_CLOUD_MODEL = 'fast-gpt-j';

  /**
   * Default GPU/CPU status: TRUE (use GPU) / FALSE (use CPU).
   */
  const NLP_CLOUD_GPU = TRUE;

  /**
   * Generates a whole blog post out of the provided input and options.
   *
   * @param string $title
   *   The title of your blog post. 50 tokens maximum.
   *
   * @return array
   *   The generation blog post HTML.
   */
  public function execute(string $title): array {
    try {
      $language = trim($this->configuration['language']);
      $client = $this->getClient(self::NLP_CLOUD_MODEL, self::NLP_CLOUD_GPU, $language);
      $result = $client->articleGeneration($title);
      return ['default' => $result->generated_article];
    }
    catch (\Throwable $error) {
      $this->logger->error('NLP Cloud Blog Post Generation error: %message.', [
        '%message' => $error->getMessage(),
      ]);
      return [
        '_errors' => $this->t('Error during the NLP Cloud blog post generation, please check the logs for more information.')->render(),
      ];
    }
  }

}
