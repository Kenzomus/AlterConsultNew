<?php

namespace Drupal\augmentor_nlpcloud\Plugin\Augmentor;

use Drupal\augmentor_nlpcloud\NPLCloudBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * NLP Cloud Text generation augmentor plugin implementation.
 *
 * @Augmentor(
 *   id = "augmentor_nlpcloud_text_generation",
 *   label = @Translation("NLP CLoud Text generation"),
 *   description = @Translation("Start a sentence and let the AI generate the
 *   rest for you, in many languages. You can achieve almost any text processing
 *   and text generation use case thanks to text generation with GPT-J and
 *   few-shot learning. You can also fine-tune GPT-J on NLP Cloud. We are using
 *   GPT-J and GPT-NeoX 20B with PyTorch and Hugging Face transformers. They are
 *   powerful open-source equivalents of OpenAI GPT-3. You can also use your own
 *   model."),
 * )
 */
class NLPCloudTextGeneration extends NPLCloudBase {

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
      '#default_value' => $this->configuration['model'] ?? 'gpt-j',
      '#description' => $this->t('Specifies the model which you want to use for text generation.'),
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
   * Generates text from the provided input text.
   *
   * @param string $text
   *   The block of text that starts the generated text.
   *   1024 tokens maximum.
   *
   * @return array
   *   The generated text.
   */
  public function execute(string $text): array {
    try {
      $language = trim($this->configuration['language']);
      $model = trim($this->configuration['model']);
      $client = $this->getClient($model, self::NLP_CLOUD_GPU, $language);
      $result = $client->generation($text, NULL, 50);
      return ['default' => $result->generated_text];
    }
    catch (\Throwable $error) {
      $this->logger->error('NLP Cloud text generation error: %message.', [
        '%message' => $error->getMessage(),
      ]);
      return [
        '_errors' => $this->t('Error during the NLP Cloud text generation, please check the logs for more information.')->render(),
      ];
    }
  }

  /**
   * Returns the list of supported models by Text generation.
   *
   * @return array
   *   With the list of supported models.
   */
  private function getSupportedModels(): array {
    return [
      'gpt-j' => $this->t('GPT-J'),
      'fast-gpt-j' => $this->t('Fast GPT-J'),
      'gpt-neox-20b' => $this->t('GPT-NeoX 20B'),
      'finetuned-gpt-neox-20b' => $this->t('Finetuned GPT-NeoX 20B'),
    ];
  }

}
