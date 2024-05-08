<?php

namespace Drupal\augmentor_google_cloud_text_to_speech\Plugin\Augmentor;

use Drupal\augmentor_google_cloud_text_to_speech\GoogleCloudTextToSpeechBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\media\Entity\Media;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Google\Cloud\TextToSpeech\V1\SynthesizeSpeechResponse;
use Drupal\Core\File\FileSystemInterface;
use Drupal\file\FileInterface;
use Drupal\Core\StreamWrapper\StreamWrapperInterface;

/**
 * Text-to-Speech Augmentor plugin implementation.
 *
 * @Augmentor(
 *   id = "augmentor_google_cloud_text_to_speech",
 *   label = @Translation("Google Cloud Text-to-Speech"),
 *   description = @Translation("Transform text to speech and save it as a file."),
 * )
 */
class TextToSpeech extends GoogleCloudTextToSpeechBase {
  /**
   * Constants to use in the default voice settings.
   */
  const SAMPLE_RATE_HERTZ = 24000;
  const VOICE_NAME = 'en-US-Wavenet-D';

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return parent::defaultConfiguration() + [
      'file_directory' => NULL,
      'uri_scheme' => NULL,
      'voice_name' => NULL,
      'speed' => NULL,
      'pitch' => NULL,
      'save_as_media' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);

    if ($this->configuration['key']) {
      $form['voice_name'] = [
        '#type' => 'select',
        '#title' => $this->t('Voice name'),
        '#options' => $this->getVoices(),
        '#default_value' => $this->configuration['voice_name'] ?? self::VOICE_NAME,
        '#description' => $this->t("Please select voice with proper language. English is for example starting with en-US (default is en-US-Wavenet-D)."),
      ];
    }

    $form['speed'] = [
      '#type' => 'number',
      '#step' => '.01',
      '#min' => 0.25,
      '#max' => 4.0,
      '#title' => $this->t('Speed'),
      '#default_value' => $this->configuration['speed'] ?? 1.00,
      '#description' => $this->t("Set speed in X.XX format (for example 1.00). Value must be higher than 0.25 and lover than 4.0"),
    ];

    $form['pitch'] = [
      '#type' => 'number',
      '#step' => '.01',
      '#min' => -20.0,
      '#max' => 20.0,
      '#title' => $this->t('Pitch'),
      '#default_value' => $this->configuration['pitch'] ?? 0.00,
      '#description' => $this->t("Set pitch in X.XX format (for example 0.00). Value must be higher than -20.0 and lover than 20.0"),
    ];

    $form['file_directory'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Choose file_directory where speech file will be stored.'),
      '#default_value' => $this->configuration['file_directory'],
      '#description' => $this->t('Optional subdirectory within the upload destination where files will be stored. Do not include preceding or trailing slashes.'),
      '#element_validate' => [
        [
          '\Drupal\file\Plugin\Field\FieldType\FileItem',
          'validateDirectory',
        ],
      ],
    ];

    $form['uri_scheme'] = [
      '#type' => 'radios',
      '#title' => $this->t('Upload destination'),
      '#options' => \Drupal::service('stream_wrapper_manager')->getNames(StreamWrapperInterface::WRITE_VISIBLE),
      '#default_value' => $this->configuration['uri_scheme'],
      '#description' => $this->t('Select where the final files should be stored. Private file storage has significantly more overhead than public files, but allows restricted access to the files.'),
    ];

    $form['save_as_media'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Save as media'),
      '#default_value' => $this->configuration['save_as_media'],
      '#description' => $this->t("Save as a media entity. If not checked, file will be saved as a file entity."),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);
    $this->configuration['voice_name'] = $form_state->getValue('voice_name');
    $this->configuration['file_directory'] = $form_state->getValue('file_directory');
    $this->configuration['speed'] = $form_state->getValue('speed');
    $this->configuration['pitch'] = $form_state->getValue('pitch');
    $this->configuration['uri_scheme'] = $form_state->getValue('uri_scheme');
    $this->configuration['save_as_media'] = $form_state->getValue('save_as_media');
  }

  /**
   * Perform text to speech on selected field.
   *
   * @param string $input
   *   The text to use as source for the speech generation.
   *
   * @return array
   *   with media entity id, file entity id and file url
   */
  public function execute($input) {
    if (strlen($input) < 1) {
      return [
        '_errors' => $this->t('No text string selected. Please select part of text that you want to translate to speech.')->render(),
      ];
    }

    // Ensure we have proper line breaks to have the text read properly.
    $input = str_replace("\n\n", ".\n\n", $input);
    $input = str_replace("..\n\n", ".\n\n", $input);

    $output = [
      'mid' => NULL,
      'fid' => NULL,
      'url' => NULL,
    ];

    $this->setEnvironmentalCredentials();
    $text_to_speech_client = new TextToSpeechClient();

    // Prepare input data.
    $synthesis_input = new SynthesisInput();
    $synthesis_input->setText(strip_tags(html_entity_decode($input)));

    // Prepare voice profile.
    $voice_name = $this->configuration['voice_name'] ?? self::VOICE_NAME;
    $voice = new VoiceSelectionParams();
    $voice->setLanguageCode($this->getLangcode($voice_name) ?? 'en-US');
    $voice->setName($voice_name);

    // Prepare audio configuration.
    $audioConfig = new AudioConfig();
    $audioConfig->setPitch($this->configuration['pitch'] ?? 0.00);
    $audioConfig->setSampleRateHertz(self::SAMPLE_RATE_HERTZ);
    $audioConfig->setSpeakingRate($this->configuration['speed'] ?? 1.0);
    $audioConfig->setAudioEncoding(AudioEncoding::MP3);

    // Perform text to speech transformation.
    $response = $text_to_speech_client->synthesizeSpeech($synthesis_input, $voice, $audioConfig);
    $filename = $this->normalizeText(substr($input, 0, 25));
    $filename = str_replace(' ', '_', $filename);
    $file = $this->createFileEntity($filename, $response);

    // Prepare output keyed array.
    $output['fid'] = $file->id();
    $output['url'] = $file->createFileUrl(FALSE);

    if ($this->configuration['save_as_media']) {
      $output['mid'] = $this->createMediaEntity($file)->id();
    }

    return $output;
  }

  /**
   * Get list of available voices.
   *
   * @return array
   *   Give back array of voices names.
   */
  private function getVoices() {
    $this->setEnvironmentalCredentials();

    if ($text_to_speech_client = new TextToSpeechClient()) {
      $voices = [];
      $voices_response = $text_to_speech_client->listVoices()
        ->getVoices()
        ->getIterator();

      foreach ($voices_response as $voice_response) {
        $voices[$voice_response->getName()] = $voice_response->getName();
      }

      return $voices;
    }

    return [
      'not_available' => $this->t('Not available'),
    ];
  }

  /**
   * Helper to extract the language code.
   *
   * @return array|bool
   *   The extracted language code, or FALSE if not found.
   */
  private function getLangcode($string) {
    preg_match('/[a-z][a-z]([a-z]*)-[a-zA-Z][a-zA-Z]/', $string, $matches);
    if (isset($matches[0])) {
      return $matches[0];
    }
    return FALSE;
  }

  /**
   * Helper function to create a file object using given filename and response.
   *
   * @param string $filename
   *   The filename to use as name for the generated file.
   * @param \Google\Cloud\TextToSpeech\V1\SynthesizeSpeechResponse $response
   *   The message returned to the client by the `SynthesizeSpeech` method.
   *
   * @return \Drupal\file\FileInterface
   *   The file entity object.
   */
  private function createFileEntity($filename, SynthesizeSpeechResponse $response) {
    $destination = trim($this->configuration['file_directory'], '/');
    $destination = $this->configuration['uri_scheme'] . '://' . $destination;

    $this->fileSystem->prepareDirectory($destination, FileSystemInterface::CREATE_DIRECTORY);
    $filename = str_replace('.', '', $filename);
    $destination = $destination . '/' . $filename . '.mp3';

    return $this->fileRepository->writeData($response->getAudioContent(), $destination, FileSystemInterface::EXISTS_REPLACE);
  }

  /**
   * Helper function to create a media entity using a file entity.
   *
   * @param \Drupal\file\FileInterface $file
   *   The file entity.
   *
   * @return \Drupal\media\Entity\Media
   *   The entity object.
   */
  private function createMediaEntity(FileInterface $file) {
    $media = Media::create([
      'bundle' => 'file',
      'uid' => $this->currentUser->id(),
      'field_media_file' => [
        'target_id' => $file->id(),
      ],
    ]);

    $media->setName($file->getFilename())->setPublished(TRUE)->save();

    return $media;
  }

}
