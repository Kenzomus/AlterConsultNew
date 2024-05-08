<?php

namespace Drupal\augmentor_aws\Plugin\Augmentor;

use Drupal\augmentor\AugmentorBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Aws\Rekognition\RekognitionClient;

/**
 * AWS Rekognition Augmentor plugin implementation.
 *
 * @Augmentor(
 *   id = "rekognition_detect_faces",
 *   label = @Translation("AWS Rekognition Detect Faces"),
 *   description = @Translation("Detects faces within an image that is provided as input. For each face detected, the operation returns face details."),
 * )
 */
class RekognitionDetectFaces extends AugmentorBase implements ContainerFactoryPluginInterface {
  /**
   * Constants to use in the default rekognition settings.
   */
  const VERSION = 'latest';
  const REGION_CODE = 'ap-southeast-2';

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return parent::defaultConfiguration() + [
      'version' => NULL,
      'region_code' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);
    unset($form['key']);

    $form['version'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Version'),
      '#default_value' => $this->configuration['version'] ?? self::VERSION,
      '#description' => $this->t('The version of the web service to use (e.g., 2006-03-01).'),
      '#required' => TRUE,
    ];

    $form['region_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Region Code'),
      '#default_value' => $this->configuration['region_code'] ?? self::REGION_CODE,
      '#description' => $this->t('AWS Region to connect to. See https://docs.aws.amazon.com/general/latest/gr/rande.html#region-names-codes'),
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);
    $this->configuration['version'] = $form_state->getValue('version');
    $this->configuration['region_code'] = $form_state->getValue('region_code');
  }

  /**
   * Detects faces within an image that is provided as input.
   *
   * @param string $path
   *   Input text to be processed.
   *
   * @return array
   *   The output of the processing.
   *
   * @see https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#detectfaces
   */
  public function execute($path) {
    $rekognition = new RekognitionClient([
      'region'  => $this->configuration['region_code'],
      'version' => $this->configuration['version'],
    ]);

    $handle = fopen($path, "rb");
    $image = stream_get_contents($handle);
    fclose($handle);

    $result = $rekognition->DetectFaces([
      'Image' => [
        'Bytes' => $image,
      ],
      'Attributes' => ['ALL'],
    ]
    );

    return ['default' => $result['FaceDetails']];
  }

}
