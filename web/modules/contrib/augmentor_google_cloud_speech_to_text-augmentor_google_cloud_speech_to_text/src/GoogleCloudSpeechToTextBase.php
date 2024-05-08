<?php

namespace Drupal\augmentor_google_cloud_speech_to_text;

use Drupal\augmentor\AugmentorBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * Google Cloud Speech-to-Text augmentor plugin implementation.
 */

/**
 * Provides a base class for Google Cloud Speech-to-Text augmentors.
 *
 * @see \Drupal\augmentor\Annotation\Augmentor
 * @see \Drupal\augmentor\AugmentorInterface
 * @see \Drupal\augmentor\AugmentorManager
 * @see \Drupal\augmentor\AugmentorBase
 * @see plugin_api
 */
class GoogleCloudSpeechToTextBase extends AugmentorBase implements ContainerFactoryPluginInterface {

  /**
   * Environment variable name to use to store the application credentials.
   */
  const GA_CREDENTIALS = 'GOOGLE_APPLICATION_CREDENTIALS';

  /**
   * Sets the environment credentials for the Google Cloud Vision application.
   */
  public function setEnvironmentalCredentials() {
    if (!getenv(self::GA_CREDENTIALS)) {
      putenv(self::GA_CREDENTIALS . '=' . $this->getKeyObject()->get('key_provider_settings')['file_location']);
    }
  }

}
