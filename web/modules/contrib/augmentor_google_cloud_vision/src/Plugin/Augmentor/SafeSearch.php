<?php

namespace Drupal\augmentor_google_cloud_vision\Plugin\Augmentor;

use Drupal\augmentor_google_cloud_vision\GoogleCloudVisionBase;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\SafeSearchAnnotation;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Safe Search Detection Augmentor plugin implementation.
 *
 * @Augmentor(
 *   id = "google_cloud_vision_safe_search",
 *   label = @Translation("Google Cloud Vision Safe Search"),
 *   description = @Translation("Detects explicit content such as adult content or violent content within an image."),
 * )
 */
class SafeSearch extends GoogleCloudVisionBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return parent::defaultConfiguration() + [
      'send_image_path' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);

    $form['send_image_path'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Send Image path'),
      '#default_value' => $this->configuration['send_image_path'],
      '#description' => $this->t("To avoid memory issues encodind in base 64 images, you can send the image path instead of the image itself."),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);
    $this->configuration['send_image_path'] = $form_state->getValue('send_image_path');
  }

  /**
   * Perform explicit content detection on a given image.
   *
   * @param string $path
   *   The image path to process.
   *
   * @return array
   *   Returns the likelihood of explicit content in a given image.
   *   @see https://cloud.google.com/vision/docs/detecting-safe-search
   */
  public function execute($path) {
    try {
      $this->setEnvironmentalCredentials();
      $imageAnnotator = new ImageAnnotatorClient();

      $image = $this->loadImage($path);
      $response = $imageAnnotator->safeSearchDetection($image);
      $safeSearchAnnotation = $response->getSafeSearchAnnotation();

      $detectionResult = $this->parseDetectionResult($safeSearchAnnotation);
      $imageAnnotator->close();

      return $detectionResult;
    }
    catch (\Throwable $error) {
      $this->logger->error('Google Cloud Vision API error: %message.', [
        '%message' => $error->getMessage(),
      ]);
      return [
        '_errors' => $this->t('Error during the explicit content detection, please check the logs for more information.')->render(),
      ];
    }
  }

  /**
   * Load image from path or from base64 encoded string.
   *
   * @param string $path
   *   The image path to process.
   *
   * @return string
   *   Returns the image content.
   */
  private function loadImage($path) {
    if ($this->configuration['send_image_path']) {
      // @TODO use dependency injection.
      return \Drupal::service('file_url_generator')->generateAbsoluteString($path);
    }
    else {
      return file_get_contents($path);
    }
  }

  /**
   * Parse the detection result.
   *
   * @param Google\Cloud\Vision\V1\SafeSearchAnnotation $safeSearchAnnotation
   *   The detection result.
   *
   * @return array
   *   The parsed detection results.
   */
  private function parseDetectionResult(SafeSearchAnnotation $safeSearchAnnotation) {
    if (!$safeSearchAnnotation) {
      return [];
    }

    return [
      'adult' => [$safeSearchAnnotation->getAdult()],
      'spoof' => [$safeSearchAnnotation->getSpoof()],
      'medical' => [$safeSearchAnnotation->getMedical()],
      'violence' => [$safeSearchAnnotation->getViolence()],
      'racy' => [$safeSearchAnnotation->getRacy()],
    ];
  }

}
