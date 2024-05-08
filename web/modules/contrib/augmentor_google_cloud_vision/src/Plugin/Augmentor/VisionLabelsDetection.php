<?php

namespace Drupal\augmentor_google_cloud_vision\Plugin\Augmentor;

use Drupal\augmentor_google_cloud_vision\GoogleCloudVisionBase;
use Drupal\Core\Form\FormStateInterface;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

/**
 * Vision Labels Detection Augmentor plugin implementation.
 *
 * @Augmentor(
 *   id = "google_cloud_vision_labels_detection",
 *   label = @Translation("Google Cloud Vision Label Detection"),
 *   description = @Translation("Detect labels on an image"),
 * )
 */
class VisionLabelsDetection extends GoogleCloudVisionBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return parent::defaultConfiguration() + [
      'max_labels' => NULL,
      'min_score' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);

    $form['max_labels'] = [
      '#type' => 'number',
      '#title' => $this->t('Max number of labels'),
      '#default_value' => $this->configuration['max_labels'],
      '#description' => $this->t('The maximum number of labels to detect from a given image.'),
    ];

    $form['min_score'] = [
      '#type' => 'number',
      '#step' => '.01',
      '#title' => $this->t('Min score'),
      '#default_value' => $this->configuration['min_score'] ?? 0.7,
      '#description' => $this->t('The confidence score, which ranges from 0 (no confidence) to 1 (very high confidence).'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);
    $this->configuration['max_labels'] = $form_state->getValue('max_labels');
    $this->configuration['min_score'] = $form_state->getValue('min_score');
  }

  /**
   * Perform label detection on a given image path.
   *
   * @param string $path
   *   The image path to process.
   *
   * @return array
   *   The detected labels.
   */
  public function execute($path) {
    try {
      $this->setEnvironmentalCredentials();
      $image_annotator = new ImageAnnotatorClient();
      $response = $image_annotator->labelDetection(file_get_contents($path));
      $label_annotations = $response->getLabelAnnotations();
      $labels = [];

      if ($label_annotations) {
        foreach ($label_annotations as $label_annotation) {
          if (count($labels) >= $this->configuration['max_labels']) {
            break;
          }
          $labels[] = $label_annotation->getDescription();
        }
      }

      $image_annotator->close();

      if (empty($labels)) {
        return [
          '_errors' => $this->t('Error during the labels detection, please check the logs for more information.')->render(),
        ];
      }
      else {
        return ['default' => $labels];
      }
    }
    catch (\Throwable $error) {
      $this->logger->error('Google Cloud Vision API error: %message.', [
        '%message' => $error->getMessage(),
      ]);
      return [
        '_errors' => $this->t('Error during the labels detection, please check the logs for more information.')->render(),
      ];
    }
  }

}
