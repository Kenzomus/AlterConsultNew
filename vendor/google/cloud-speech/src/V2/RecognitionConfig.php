<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/speech/v2/cloud_speech.proto

namespace Google\Cloud\Speech\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Provides information to the Recognizer that specifies how to process the
 * recognition request.
 *
 * Generated from protobuf message <code>google.cloud.speech.v2.RecognitionConfig</code>
 */
class RecognitionConfig extends \Google\Protobuf\Internal\Message
{
    /**
     * Optional. Which model to use for recognition requests. Select the model
     * best suited to your domain to get best results.
     * Guidance for choosing which model to use can be found in the [Transcription
     * Models
     * Documentation](https://cloud.google.com/speech-to-text/v2/docs/transcription-model)
     * and the models supported in each region can be found in the [Table Of
     * Supported
     * Models](https://cloud.google.com/speech-to-text/v2/docs/speech-to-text-supported-languages).
     *
     * Generated from protobuf field <code>string model = 9 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $model = '';
    /**
     * Optional. The language of the supplied audio as a
     * [BCP-47](https://www.rfc-editor.org/rfc/bcp/bcp47.txt) language tag.
     * Language tags are normalized to BCP-47 before they are used eg "en-us"
     * becomes "en-US".
     * Supported languages for each model are listed in the [Table of Supported
     * Models](https://cloud.google.com/speech-to-text/v2/docs/speech-to-text-supported-languages).
     * If additional languages are provided, recognition result will contain
     * recognition in the most likely language detected. The recognition result
     * will include the language tag of the language detected in the audio.
     *
     * Generated from protobuf field <code>repeated string language_codes = 10 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $language_codes;
    /**
     * Speech recognition features to enable.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.RecognitionFeatures features = 2;</code>
     */
    private $features = null;
    /**
     * Speech adaptation context that weights recognizer predictions for specific
     * words and phrases.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.SpeechAdaptation adaptation = 6;</code>
     */
    private $adaptation = null;
    /**
     * Optional. Use transcription normalization to automatically replace parts of
     * the transcript with phrases of your choosing. For StreamingRecognize, this
     * normalization only applies to stable partial transcripts (stability > 0.8)
     * and final transcripts.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.TranscriptNormalization transcript_normalization = 11 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $transcript_normalization = null;
    /**
     * Optional. Optional configuration used to automatically run translation on
     * the given audio to the desired language for supported models.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.TranslationConfig translation_config = 15 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $translation_config = null;
    protected $decoding_config;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\Speech\V2\AutoDetectDecodingConfig $auto_decoding_config
     *           Automatically detect decoding parameters.
     *           Preferred for supported formats.
     *     @type \Google\Cloud\Speech\V2\ExplicitDecodingConfig $explicit_decoding_config
     *           Explicitly specified decoding parameters.
     *           Required if using headerless PCM audio (linear16, mulaw, alaw).
     *     @type string $model
     *           Optional. Which model to use for recognition requests. Select the model
     *           best suited to your domain to get best results.
     *           Guidance for choosing which model to use can be found in the [Transcription
     *           Models
     *           Documentation](https://cloud.google.com/speech-to-text/v2/docs/transcription-model)
     *           and the models supported in each region can be found in the [Table Of
     *           Supported
     *           Models](https://cloud.google.com/speech-to-text/v2/docs/speech-to-text-supported-languages).
     *     @type array<string>|\Google\Protobuf\Internal\RepeatedField $language_codes
     *           Optional. The language of the supplied audio as a
     *           [BCP-47](https://www.rfc-editor.org/rfc/bcp/bcp47.txt) language tag.
     *           Language tags are normalized to BCP-47 before they are used eg "en-us"
     *           becomes "en-US".
     *           Supported languages for each model are listed in the [Table of Supported
     *           Models](https://cloud.google.com/speech-to-text/v2/docs/speech-to-text-supported-languages).
     *           If additional languages are provided, recognition result will contain
     *           recognition in the most likely language detected. The recognition result
     *           will include the language tag of the language detected in the audio.
     *     @type \Google\Cloud\Speech\V2\RecognitionFeatures $features
     *           Speech recognition features to enable.
     *     @type \Google\Cloud\Speech\V2\SpeechAdaptation $adaptation
     *           Speech adaptation context that weights recognizer predictions for specific
     *           words and phrases.
     *     @type \Google\Cloud\Speech\V2\TranscriptNormalization $transcript_normalization
     *           Optional. Use transcription normalization to automatically replace parts of
     *           the transcript with phrases of your choosing. For StreamingRecognize, this
     *           normalization only applies to stable partial transcripts (stability > 0.8)
     *           and final transcripts.
     *     @type \Google\Cloud\Speech\V2\TranslationConfig $translation_config
     *           Optional. Optional configuration used to automatically run translation on
     *           the given audio to the desired language for supported models.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Speech\V2\CloudSpeech::initOnce();
        parent::__construct($data);
    }

    /**
     * Automatically detect decoding parameters.
     * Preferred for supported formats.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.AutoDetectDecodingConfig auto_decoding_config = 7;</code>
     * @return \Google\Cloud\Speech\V2\AutoDetectDecodingConfig|null
     */
    public function getAutoDecodingConfig()
    {
        return $this->readOneof(7);
    }

    public function hasAutoDecodingConfig()
    {
        return $this->hasOneof(7);
    }

    /**
     * Automatically detect decoding parameters.
     * Preferred for supported formats.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.AutoDetectDecodingConfig auto_decoding_config = 7;</code>
     * @param \Google\Cloud\Speech\V2\AutoDetectDecodingConfig $var
     * @return $this
     */
    public function setAutoDecodingConfig($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Speech\V2\AutoDetectDecodingConfig::class);
        $this->writeOneof(7, $var);

        return $this;
    }

    /**
     * Explicitly specified decoding parameters.
     * Required if using headerless PCM audio (linear16, mulaw, alaw).
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.ExplicitDecodingConfig explicit_decoding_config = 8;</code>
     * @return \Google\Cloud\Speech\V2\ExplicitDecodingConfig|null
     */
    public function getExplicitDecodingConfig()
    {
        return $this->readOneof(8);
    }

    public function hasExplicitDecodingConfig()
    {
        return $this->hasOneof(8);
    }

    /**
     * Explicitly specified decoding parameters.
     * Required if using headerless PCM audio (linear16, mulaw, alaw).
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.ExplicitDecodingConfig explicit_decoding_config = 8;</code>
     * @param \Google\Cloud\Speech\V2\ExplicitDecodingConfig $var
     * @return $this
     */
    public function setExplicitDecodingConfig($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Speech\V2\ExplicitDecodingConfig::class);
        $this->writeOneof(8, $var);

        return $this;
    }

    /**
     * Optional. Which model to use for recognition requests. Select the model
     * best suited to your domain to get best results.
     * Guidance for choosing which model to use can be found in the [Transcription
     * Models
     * Documentation](https://cloud.google.com/speech-to-text/v2/docs/transcription-model)
     * and the models supported in each region can be found in the [Table Of
     * Supported
     * Models](https://cloud.google.com/speech-to-text/v2/docs/speech-to-text-supported-languages).
     *
     * Generated from protobuf field <code>string model = 9 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Optional. Which model to use for recognition requests. Select the model
     * best suited to your domain to get best results.
     * Guidance for choosing which model to use can be found in the [Transcription
     * Models
     * Documentation](https://cloud.google.com/speech-to-text/v2/docs/transcription-model)
     * and the models supported in each region can be found in the [Table Of
     * Supported
     * Models](https://cloud.google.com/speech-to-text/v2/docs/speech-to-text-supported-languages).
     *
     * Generated from protobuf field <code>string model = 9 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param string $var
     * @return $this
     */
    public function setModel($var)
    {
        GPBUtil::checkString($var, True);
        $this->model = $var;

        return $this;
    }

    /**
     * Optional. The language of the supplied audio as a
     * [BCP-47](https://www.rfc-editor.org/rfc/bcp/bcp47.txt) language tag.
     * Language tags are normalized to BCP-47 before they are used eg "en-us"
     * becomes "en-US".
     * Supported languages for each model are listed in the [Table of Supported
     * Models](https://cloud.google.com/speech-to-text/v2/docs/speech-to-text-supported-languages).
     * If additional languages are provided, recognition result will contain
     * recognition in the most likely language detected. The recognition result
     * will include the language tag of the language detected in the audio.
     *
     * Generated from protobuf field <code>repeated string language_codes = 10 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getLanguageCodes()
    {
        return $this->language_codes;
    }

    /**
     * Optional. The language of the supplied audio as a
     * [BCP-47](https://www.rfc-editor.org/rfc/bcp/bcp47.txt) language tag.
     * Language tags are normalized to BCP-47 before they are used eg "en-us"
     * becomes "en-US".
     * Supported languages for each model are listed in the [Table of Supported
     * Models](https://cloud.google.com/speech-to-text/v2/docs/speech-to-text-supported-languages).
     * If additional languages are provided, recognition result will contain
     * recognition in the most likely language detected. The recognition result
     * will include the language tag of the language detected in the audio.
     *
     * Generated from protobuf field <code>repeated string language_codes = 10 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param array<string>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setLanguageCodes($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->language_codes = $arr;

        return $this;
    }

    /**
     * Speech recognition features to enable.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.RecognitionFeatures features = 2;</code>
     * @return \Google\Cloud\Speech\V2\RecognitionFeatures|null
     */
    public function getFeatures()
    {
        return $this->features;
    }

    public function hasFeatures()
    {
        return isset($this->features);
    }

    public function clearFeatures()
    {
        unset($this->features);
    }

    /**
     * Speech recognition features to enable.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.RecognitionFeatures features = 2;</code>
     * @param \Google\Cloud\Speech\V2\RecognitionFeatures $var
     * @return $this
     */
    public function setFeatures($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Speech\V2\RecognitionFeatures::class);
        $this->features = $var;

        return $this;
    }

    /**
     * Speech adaptation context that weights recognizer predictions for specific
     * words and phrases.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.SpeechAdaptation adaptation = 6;</code>
     * @return \Google\Cloud\Speech\V2\SpeechAdaptation|null
     */
    public function getAdaptation()
    {
        return $this->adaptation;
    }

    public function hasAdaptation()
    {
        return isset($this->adaptation);
    }

    public function clearAdaptation()
    {
        unset($this->adaptation);
    }

    /**
     * Speech adaptation context that weights recognizer predictions for specific
     * words and phrases.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.SpeechAdaptation adaptation = 6;</code>
     * @param \Google\Cloud\Speech\V2\SpeechAdaptation $var
     * @return $this
     */
    public function setAdaptation($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Speech\V2\SpeechAdaptation::class);
        $this->adaptation = $var;

        return $this;
    }

    /**
     * Optional. Use transcription normalization to automatically replace parts of
     * the transcript with phrases of your choosing. For StreamingRecognize, this
     * normalization only applies to stable partial transcripts (stability > 0.8)
     * and final transcripts.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.TranscriptNormalization transcript_normalization = 11 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return \Google\Cloud\Speech\V2\TranscriptNormalization|null
     */
    public function getTranscriptNormalization()
    {
        return $this->transcript_normalization;
    }

    public function hasTranscriptNormalization()
    {
        return isset($this->transcript_normalization);
    }

    public function clearTranscriptNormalization()
    {
        unset($this->transcript_normalization);
    }

    /**
     * Optional. Use transcription normalization to automatically replace parts of
     * the transcript with phrases of your choosing. For StreamingRecognize, this
     * normalization only applies to stable partial transcripts (stability > 0.8)
     * and final transcripts.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.TranscriptNormalization transcript_normalization = 11 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param \Google\Cloud\Speech\V2\TranscriptNormalization $var
     * @return $this
     */
    public function setTranscriptNormalization($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Speech\V2\TranscriptNormalization::class);
        $this->transcript_normalization = $var;

        return $this;
    }

    /**
     * Optional. Optional configuration used to automatically run translation on
     * the given audio to the desired language for supported models.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.TranslationConfig translation_config = 15 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return \Google\Cloud\Speech\V2\TranslationConfig|null
     */
    public function getTranslationConfig()
    {
        return $this->translation_config;
    }

    public function hasTranslationConfig()
    {
        return isset($this->translation_config);
    }

    public function clearTranslationConfig()
    {
        unset($this->translation_config);
    }

    /**
     * Optional. Optional configuration used to automatically run translation on
     * the given audio to the desired language for supported models.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.TranslationConfig translation_config = 15 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param \Google\Cloud\Speech\V2\TranslationConfig $var
     * @return $this
     */
    public function setTranslationConfig($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Speech\V2\TranslationConfig::class);
        $this->translation_config = $var;

        return $this;
    }

    /**
     * @return string
     */
    public function getDecodingConfig()
    {
        return $this->whichOneof("decoding_config");
    }

}
