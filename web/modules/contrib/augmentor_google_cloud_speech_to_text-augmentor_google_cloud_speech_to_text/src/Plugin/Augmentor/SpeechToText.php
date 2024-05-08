<?php

namespace Drupal\augmentor_google_cloud_speech_to_text\Plugin\Augmentor;

use Drupal\augmentor_google_cloud_speech_to_text\GoogleCloudSpeechToTextBase;
use Drupal\Core\Form\FormStateInterface;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\SpeechClient;

/**
 * Speech-to-Text Augmentor plugin implementation.
 *
 * @Augmentor(
 *   id = "augmentor_google_cloud_speech_to_text",
 *   label = @Translation("Google Cloud Speech-to-Text"),
 *   description = @Translation("Send audio and receive a text transcription from the Speech-to-Text API service."),
 * )
 */
class SpeechToText extends GoogleCloudSpeechToTextBase {
  /**
   * Constants to use in the default audio settings.
   */
  const SAMPLE_RATE_HERTZ = 44100;
  const LANGUAGE_CODE = 'en-US';

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return parent::defaultConfiguration() + [
      'encoding' => NULL,
      'sample_rate_hertz' => NULL,
      'max_alternatives' => NULL,
      'language_code' => NULL,
      'profanity_filter' => NULL,
      'speech_context' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);

    $form['encoding'] = [
      '#type' => 'select',
      '#title' => $this->t('Encoding'),
      '#options' => $this->getSupportedAudioCodecs(),
      '#default_value' => $this->configuration['encoding'] ?? AudioEncoding::FLAC,
      '#description' => $this->t("Specifies the encoding scheme of the supplied audio (of type AudioEncoding). 
        If you have a choice in codec, prefer a lossless encoding such as FLAC or LINEAR16 for best performance."),
    ];

    $form['sample_rate_hertz'] = [
      '#type' => 'number',
      '#title' => $this->t('Sample Rate Hertz'),
      '#default_value' => $this->configuration['sample_rate_hertz'] ?? self::SAMPLE_RATE_HERTZ,
      '#description' => $this->t("Specifies the sample rate (in Hertz) of the supplied audio."),
    ];

    $form['max_alternatives'] = [
      '#type' => 'number',
      '#title' => $this->t('Max Alternatives'),
      '#default_value' => $this->configuration['max_alternatives'] ?? 1,
      '#description' => $this->t("Indicates the number of alternative transcriptions to provide in the response."),
    ];

    $form['language_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Language Code'),
      '#default_value' => $this->configuration['language_code'] ?? self::LANGUAGE_CODE,
      '#description' => $this->t('Contains the language + region/locale to use for speech recognition of the supplied audio.
        The language code must be a BCP-47 identifier.'),
    ];

    $form['profanity_filter'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Profanity Filter') ?? FALSE,
      '#default_value' => $this->configuration['profanity_filter'],
      '#description' => $this->t("Indicates whether to filter out profane words or phrases. 
        Words filtered out will contain their first letter and asterisks for the remaining characters (e.g. f***)."),
    ];

    $form['speech_context'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Speech Context'),
      '#default_value' => $this->configuration['speech_context'] ?? '',
      '#description' => $this->t('Contains a list of words and phrases (separated by comma) that provide hints to the speech recognition task.'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);
    $this->configuration['encoding'] = $form_state->getValue('encoding');
    $this->configuration['sample_rate_hertz'] = $form_state->getValue('sample_rate_hertz');
    $this->configuration['max_alternatives'] = $form_state->getValue('max_alternatives');
    $this->configuration['language_code'] = $form_state->getValue('language_code');
    $this->configuration['profanity_filter'] = $form_state->getValue('profanity_filter');
    $this->configuration['speech_context'] = $form_state->getValue('speech_context');
  }

  /**
   * Perform speech to text on selected field.
   *
   * @param string $input
   *   The audio file to use as source for the speech to text generation.
   *
   * @return array
   *   With the transcription text.
   */
  public function execute(string $input) {
    $this->setEnvironmentalCredentials();

    // Get contents of a file into a string.
    $content = file_get_contents(urldecode($input));
    $output = [];

    // Set string as audio content.
    $audio = (new RecognitionAudio())->setContent($content);

    // Set configuration.
    $recognition_config = new RecognitionConfig();
    $recognition_config->setEncoding($this->configuration['encoding']);
    $recognition_config->setSampleRateHertz($this->configuration['sample_rate_hertz']);
    $recognition_config->setMaxAlternatives($this->configuration['max_alternatives']);
    $recognition_config->setLanguageCode($this->configuration['language_code']);
    $recognition_config->setProfanityFilter($this->configuration['profanity_filter']);

    // Create the speech client.
    $client = new SpeechClient();

    try {
      $response = $client->recognize($recognition_config, $audio);
      $transcript = [];

      foreach ($response->getResults() as $result) {
        $alternatives = $result->getAlternatives();
        $most_likely = $alternatives[0];
        $transcript[] = $most_likely->getTranscript();
      }

      $output['default'][] = ucfirst(implode(', ', $transcript)) . '.';
    }
    finally {
      $client->close();
    }

    return $output;
  }

  /**
   * Returns the list of supported audio codecs by Speech-to-Text API.
   *
   * @see https://cloud.google.com/speech-to-text/docs/encoding#audio-encodings
   *
   * @return array
   *   With the list of supported audio codecs.
   */
  private function getSupportedAudioCodecs() {
    return [
      AudioEncoding::ENCODING_UNSPECIFIED => 'ENCODING_UNSPECIFIED',
      AudioEncoding::LINEAR16 => 'LINEAR16',
      AudioEncoding::FLAC => 'FLAC',
      AudioEncoding::MULAW => 'MULAW',
      AudioEncoding::AMR => 'AMR',
      AudioEncoding::AMR_WB => 'AMR_WB',
      AudioEncoding::OGG_OPUS => 'OGG_OPUS',
      AudioEncoding::SPEEX_WITH_HEADER_BYTE => 'SPEEX_WITH_HEADER_BYTE',
      AudioEncoding::WEBM_OPUS => 'WEBM_OPUS',
    ];
  }

}
