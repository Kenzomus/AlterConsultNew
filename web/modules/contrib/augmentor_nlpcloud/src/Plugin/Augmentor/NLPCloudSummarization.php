<?php

namespace Drupal\augmentor_nlpcloud\Plugin\Augmentor;

use Drupal\augmentor_nlpcloud\NPLCloudBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * NLP Cloud Summarization augmentor plugin implementation.
 *
 * @Augmentor(
 *   id = "augmentor_nlpcloud_summarization",
 *   label = @Translation("NLP Cloud Summarization"),
 *   description = @Translation("Send a text, and get a smaller text keeping
 *   essential information only, in many languages We are using Facebook's Bart
 *   Large CNN and GPT-J/GPT-NeoX, with PyTorch, Jax, and Hugging Face
 *   transformers. You can also use your own model."),
 * )
 */
class NLPCloudSummarization extends NPLCloudBase {

  /**
   * Default GPU/CPU status: TRUE (use GPU) / FALSE (use CPU).
   */
  const NLP_CLOUD_GPU = FALSE;

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return parent::defaultConfiguration() + [
      'model' => NULL,
      'size' => NULL,
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
      '#default_value' => $this->configuration['model'] ?? 'bart-large-cnn',
      '#description' => $this->t('Specifies the model which you want to use for summarization.'),
    ];
    $form['size'] = [
      '#type' => 'select',
      '#title' => $this->t('Size'),
      '#options' => $this->getSupportedSizes(),
      '#default_value' => $this->configuration['size'] ?? 'small',
      '#description' => $this->t('Specifies the size which you want to use to determines the size of the summary.'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);
    $this->configuration['model'] = $form_state->getValue('model');
    $this->configuration['size'] = $form_state->getValue('size');
  }

  /**
   * Extracts summary from the provided input text.
   *
   * @param string $text
   *   The block of text that you want to summarize.
   *   1024 tokens maximum.
   *
   * @return array
   *   The summary of your text.
   */
  public function execute(string $text): array {
    try {
      $language = trim($this->configuration['language']);
      $model = trim($this->configuration['model']);
      $size = trim($this->configuration['size']);
      $client = $this->getClient($model, self::NLP_CLOUD_GPU, $language);
      $result = $client->summarization($text, $size);
      return ['default' => $result->summary_text];
    }
    catch (\Throwable $error) {
      $this->logger->error('NLP Cloud summarization error: %message.', [
        '%message' => $error->getMessage(),
      ]);
      return [
        '_errors' => $this->t('Error during the NLP Cloud summarization, please check the logs for more information.')->render(),
      ];
    }
  }

  /**
   * Returns the list of supported models by Summarization.
   *
   * @return array
   *   With the list of supported models.
   */
  private function getSupportedModels(): array {
    return [
      'bart-large-cnn' => $this->t("Facebook's Bart Large CNN model"),
      'fast-gpt-j' => $this->t('Fast GPT-J'),
      'finetuned-gpt-neox-20b' => $this->t('Finetuned GPT-NeoX 20B'),
    ];
  }

  /**
   * Returns the list of supported sizes by Summarization.
   *
   * @return array
   *   With the list of supported sizes.
   */
  private function getSupportedSizes(): array {
    return [
      'small' => $this->t('Small'),
      'large' => $this->t('Large'),
    ];
  }

}
