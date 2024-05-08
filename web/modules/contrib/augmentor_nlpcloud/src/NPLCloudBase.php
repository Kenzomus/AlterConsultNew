<?php

namespace Drupal\augmentor_nlpcloud;

use Drupal\augmentor\AugmentorBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Form\FormStateInterface;
use NLPCloud\NLPCloud;

/**
 * Provides a base augmentor class that most NLP Cloud augmentors will extend.
 *
 * @see \Drupal\augmentor\Annotation\Augmentor
 * @see \Drupal\augmentor\AugmentorInterface
 * @see \Drupal\augmentor\AugmentorManager
 * @see \Drupal\augmentor\AugmentorBase
 * @see plugin_api
 *
 * @ingroup augmentor
 */
class NPLCloudBase extends AugmentorBase implements ContainerFactoryPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return parent::defaultConfiguration() + [
      'language' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);

    $form['language'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Language'),
      '#default_value' => $this->configuration['language'] ?? '',
      '#description' => $this->t('Indicate the language of the text to be processed in order to be translated to English.'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);
    $this->configuration['language'] = $form_state->getValue('language');
  }

  /**
   * Gets the NLPCloud SDK API client.
   *
   * @param string $model
   *   Pre-trained models from various sources like spaCy, Hugging Face, etc.
   * @param bool $gpu
   *   Use GPU for better performance, especially for real-time applications or
   *   for computation-intensive models.
   * @param string $language
   *   Indicate the language of the text to be processed in order to be
   *   translated to English.
   * @param bool $asynchronous
   *   When used in asynchronous mode, the AI models accept much larger inputs.
   *
   * @return \NLPCloud\NLPCloud
   *   The NLPCloud SDK API client.
   */
  public function getClient(string $model, bool $gpu = FALSE, string $language = '', bool $asynchronous = FALSE): NLPCloud {
    if (empty($this->client)) {
      $api_key = $this->getKeyValue();

      $this->client = new NLPCloud($model, $api_key, $gpu, $language, $asynchronous);
    }
    return $this->client;
  }

}
