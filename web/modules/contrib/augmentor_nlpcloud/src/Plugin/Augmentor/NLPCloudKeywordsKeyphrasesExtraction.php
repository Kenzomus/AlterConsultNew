<?php

namespace Drupal\augmentor_nlpcloud\Plugin\Augmentor;

use Drupal\augmentor_nlpcloud\NPLCloudBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * NLP Cloud Keywords and Keyphrases augmentor plugin implementation.
 *
 * @Augmentor(
 *   id = "augmentor_nlpcloud_keywords_and_keyphrases_extraction",
 *   label = @Translation("NLP Cloud Keywords and keyphrases extraction"),
 *   description = @Translation("Extract the main keywords from a piece of text,
 *   in many languages. We are using GPT-J and GPT-NeoX 20B with PyTorch and
 *   Hugging Face transformers. They are powerful open-source equivalents of
 *   OpenAI GPT-3. You can also use your own model."),
 * )
 */
class NLPCloudKeywordsKeyphrasesExtraction extends NPLCloudBase {

  /**
   * Default GPU/CPU status: TRUE (use GPU) / FALSE (use CPU).
   */
  const NLP_CLOUD_GPU = TRUE;

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return parent::defaultConfiguration() + [
      'model' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);

    $form['model'] = [
      '#type' => 'select',
      '#title' => $this->t('Model'),
      '#options' => $this->getSupportedModels(),
      '#default_value' => $this->configuration['model'] ?? 'fast-gpt-j',
      '#description' => $this->t("Specifies the model which you want to use for keywords extraction."),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);
    $this->configuration['model'] = $form_state->getValue('model');
  }

  /**
   * Extracts keywords and keyphrases from the provided input text.
   *
   * @param string $text
   *   The text you want to extract keywords and keyphrases from.
   *   1024 tokens maximum.
   *
   * @return array
   *   The main keywords and keyphrases in your text.
   */
  public function execute(string $text): array {
    try {
      $language = trim($this->configuration['language']);
      $model = trim($this->configuration['model']);
      $client = $this->getClient($model, self::NLP_CLOUD_GPU, $language);
      $result = $client->kwKpExtraction($text);
      return ['default' => $result->keywords_and_keyphrases];
    }
    catch (\Throwable $error) {
      $this->logger->error('NLP Cloud keywords and keyphrases extraction error: %message.', [
        '%message' => $error->getMessage(),
      ]);
      return [
        '_errors' => $this->t('Error during the NLP Cloud keywords and keyphrases extraction, please check the logs for more information.')->render(),
      ];
    }
  }

  /**
   * Returns the list of supported models by Keywords and Keyphrases Extraction.
   *
   * @return array
   *   With the list of supported models.
   */
  private function getSupportedModels(): array {
    return [
      'fast-gpt-j' => $this->t('Fast GPT-J'),
      'finetuned-gpt-neox-20b' => $this->t('Finetuned GPT-NeoX 20B'),
    ];
  }

}
