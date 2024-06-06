<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/speech/v2/cloud_speech.proto

namespace Google\Cloud\Speech\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Available recognition features.
 *
 * Generated from protobuf message <code>google.cloud.speech.v2.RecognitionFeatures</code>
 */
class RecognitionFeatures extends \Google\Protobuf\Internal\Message
{
    /**
     * If set to `true`, the server will attempt to filter out profanities,
     * replacing all but the initial character in each filtered word with
     * asterisks, for instance, "f***". If set to `false` or omitted, profanities
     * won't be filtered out.
     *
     * Generated from protobuf field <code>bool profanity_filter = 1;</code>
     */
    private $profanity_filter = false;
    /**
     * If `true`, the top result includes a list of words and the start and end
     * time offsets (timestamps) for those words. If `false`, no word-level time
     * offset information is returned. The default is `false`.
     *
     * Generated from protobuf field <code>bool enable_word_time_offsets = 2;</code>
     */
    private $enable_word_time_offsets = false;
    /**
     * If `true`, the top result includes a list of words and the confidence for
     * those words. If `false`, no word-level confidence information is returned.
     * The default is `false`.
     *
     * Generated from protobuf field <code>bool enable_word_confidence = 3;</code>
     */
    private $enable_word_confidence = false;
    /**
     * If `true`, adds punctuation to recognition result hypotheses. This feature
     * is only available in select languages. The default `false` value does not
     * add punctuation to result hypotheses.
     *
     * Generated from protobuf field <code>bool enable_automatic_punctuation = 4;</code>
     */
    private $enable_automatic_punctuation = false;
    /**
     * The spoken punctuation behavior for the call. If `true`, replaces spoken
     * punctuation with the corresponding symbols in the request. For example,
     * "how are you question mark" becomes "how are you?". See
     * https://cloud.google.com/speech-to-text/docs/spoken-punctuation for
     * support. If `false`, spoken punctuation is not replaced.
     *
     * Generated from protobuf field <code>bool enable_spoken_punctuation = 14;</code>
     */
    private $enable_spoken_punctuation = false;
    /**
     * The spoken emoji behavior for the call. If `true`, adds spoken emoji
     * formatting for the request. This will replace spoken emojis with the
     * corresponding Unicode symbols in the final transcript. If `false`, spoken
     * emojis are not replaced.
     *
     * Generated from protobuf field <code>bool enable_spoken_emojis = 15;</code>
     */
    private $enable_spoken_emojis = false;
    /**
     * Mode for recognizing multi-channel audio.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.RecognitionFeatures.MultiChannelMode multi_channel_mode = 17;</code>
     */
    private $multi_channel_mode = 0;
    /**
     * Configuration to enable speaker diarization and set additional
     * parameters to make diarization better suited for your application.
     * When this is enabled, we send all the words from the beginning of the
     * audio for the top alternative in every consecutive STREAMING responses.
     * This is done in order to improve our speaker tags as our models learn to
     * identify the speakers in the conversation over time.
     * For non-streaming requests, the diarization results will be provided only
     * in the top alternative of the FINAL SpeechRecognitionResult.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.SpeakerDiarizationConfig diarization_config = 9;</code>
     */
    private $diarization_config = null;
    /**
     * Maximum number of recognition hypotheses to be returned.
     * The server may return fewer than `max_alternatives`.
     * Valid values are `0`-`30`. A value of `0` or `1` will return a maximum of
     * one. If omitted, will return a maximum of one.
     *
     * Generated from protobuf field <code>int32 max_alternatives = 16;</code>
     */
    private $max_alternatives = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type bool $profanity_filter
     *           If set to `true`, the server will attempt to filter out profanities,
     *           replacing all but the initial character in each filtered word with
     *           asterisks, for instance, "f***". If set to `false` or omitted, profanities
     *           won't be filtered out.
     *     @type bool $enable_word_time_offsets
     *           If `true`, the top result includes a list of words and the start and end
     *           time offsets (timestamps) for those words. If `false`, no word-level time
     *           offset information is returned. The default is `false`.
     *     @type bool $enable_word_confidence
     *           If `true`, the top result includes a list of words and the confidence for
     *           those words. If `false`, no word-level confidence information is returned.
     *           The default is `false`.
     *     @type bool $enable_automatic_punctuation
     *           If `true`, adds punctuation to recognition result hypotheses. This feature
     *           is only available in select languages. The default `false` value does not
     *           add punctuation to result hypotheses.
     *     @type bool $enable_spoken_punctuation
     *           The spoken punctuation behavior for the call. If `true`, replaces spoken
     *           punctuation with the corresponding symbols in the request. For example,
     *           "how are you question mark" becomes "how are you?". See
     *           https://cloud.google.com/speech-to-text/docs/spoken-punctuation for
     *           support. If `false`, spoken punctuation is not replaced.
     *     @type bool $enable_spoken_emojis
     *           The spoken emoji behavior for the call. If `true`, adds spoken emoji
     *           formatting for the request. This will replace spoken emojis with the
     *           corresponding Unicode symbols in the final transcript. If `false`, spoken
     *           emojis are not replaced.
     *     @type int $multi_channel_mode
     *           Mode for recognizing multi-channel audio.
     *     @type \Google\Cloud\Speech\V2\SpeakerDiarizationConfig $diarization_config
     *           Configuration to enable speaker diarization and set additional
     *           parameters to make diarization better suited for your application.
     *           When this is enabled, we send all the words from the beginning of the
     *           audio for the top alternative in every consecutive STREAMING responses.
     *           This is done in order to improve our speaker tags as our models learn to
     *           identify the speakers in the conversation over time.
     *           For non-streaming requests, the diarization results will be provided only
     *           in the top alternative of the FINAL SpeechRecognitionResult.
     *     @type int $max_alternatives
     *           Maximum number of recognition hypotheses to be returned.
     *           The server may return fewer than `max_alternatives`.
     *           Valid values are `0`-`30`. A value of `0` or `1` will return a maximum of
     *           one. If omitted, will return a maximum of one.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Speech\V2\CloudSpeech::initOnce();
        parent::__construct($data);
    }

    /**
     * If set to `true`, the server will attempt to filter out profanities,
     * replacing all but the initial character in each filtered word with
     * asterisks, for instance, "f***". If set to `false` or omitted, profanities
     * won't be filtered out.
     *
     * Generated from protobuf field <code>bool profanity_filter = 1;</code>
     * @return bool
     */
    public function getProfanityFilter()
    {
        return $this->profanity_filter;
    }

    /**
     * If set to `true`, the server will attempt to filter out profanities,
     * replacing all but the initial character in each filtered word with
     * asterisks, for instance, "f***". If set to `false` or omitted, profanities
     * won't be filtered out.
     *
     * Generated from protobuf field <code>bool profanity_filter = 1;</code>
     * @param bool $var
     * @return $this
     */
    public function setProfanityFilter($var)
    {
        GPBUtil::checkBool($var);
        $this->profanity_filter = $var;

        return $this;
    }

    /**
     * If `true`, the top result includes a list of words and the start and end
     * time offsets (timestamps) for those words. If `false`, no word-level time
     * offset information is returned. The default is `false`.
     *
     * Generated from protobuf field <code>bool enable_word_time_offsets = 2;</code>
     * @return bool
     */
    public function getEnableWordTimeOffsets()
    {
        return $this->enable_word_time_offsets;
    }

    /**
     * If `true`, the top result includes a list of words and the start and end
     * time offsets (timestamps) for those words. If `false`, no word-level time
     * offset information is returned. The default is `false`.
     *
     * Generated from protobuf field <code>bool enable_word_time_offsets = 2;</code>
     * @param bool $var
     * @return $this
     */
    public function setEnableWordTimeOffsets($var)
    {
        GPBUtil::checkBool($var);
        $this->enable_word_time_offsets = $var;

        return $this;
    }

    /**
     * If `true`, the top result includes a list of words and the confidence for
     * those words. If `false`, no word-level confidence information is returned.
     * The default is `false`.
     *
     * Generated from protobuf field <code>bool enable_word_confidence = 3;</code>
     * @return bool
     */
    public function getEnableWordConfidence()
    {
        return $this->enable_word_confidence;
    }

    /**
     * If `true`, the top result includes a list of words and the confidence for
     * those words. If `false`, no word-level confidence information is returned.
     * The default is `false`.
     *
     * Generated from protobuf field <code>bool enable_word_confidence = 3;</code>
     * @param bool $var
     * @return $this
     */
    public function setEnableWordConfidence($var)
    {
        GPBUtil::checkBool($var);
        $this->enable_word_confidence = $var;

        return $this;
    }

    /**
     * If `true`, adds punctuation to recognition result hypotheses. This feature
     * is only available in select languages. The default `false` value does not
     * add punctuation to result hypotheses.
     *
     * Generated from protobuf field <code>bool enable_automatic_punctuation = 4;</code>
     * @return bool
     */
    public function getEnableAutomaticPunctuation()
    {
        return $this->enable_automatic_punctuation;
    }

    /**
     * If `true`, adds punctuation to recognition result hypotheses. This feature
     * is only available in select languages. The default `false` value does not
     * add punctuation to result hypotheses.
     *
     * Generated from protobuf field <code>bool enable_automatic_punctuation = 4;</code>
     * @param bool $var
     * @return $this
     */
    public function setEnableAutomaticPunctuation($var)
    {
        GPBUtil::checkBool($var);
        $this->enable_automatic_punctuation = $var;

        return $this;
    }

    /**
     * The spoken punctuation behavior for the call. If `true`, replaces spoken
     * punctuation with the corresponding symbols in the request. For example,
     * "how are you question mark" becomes "how are you?". See
     * https://cloud.google.com/speech-to-text/docs/spoken-punctuation for
     * support. If `false`, spoken punctuation is not replaced.
     *
     * Generated from protobuf field <code>bool enable_spoken_punctuation = 14;</code>
     * @return bool
     */
    public function getEnableSpokenPunctuation()
    {
        return $this->enable_spoken_punctuation;
    }

    /**
     * The spoken punctuation behavior for the call. If `true`, replaces spoken
     * punctuation with the corresponding symbols in the request. For example,
     * "how are you question mark" becomes "how are you?". See
     * https://cloud.google.com/speech-to-text/docs/spoken-punctuation for
     * support. If `false`, spoken punctuation is not replaced.
     *
     * Generated from protobuf field <code>bool enable_spoken_punctuation = 14;</code>
     * @param bool $var
     * @return $this
     */
    public function setEnableSpokenPunctuation($var)
    {
        GPBUtil::checkBool($var);
        $this->enable_spoken_punctuation = $var;

        return $this;
    }

    /**
     * The spoken emoji behavior for the call. If `true`, adds spoken emoji
     * formatting for the request. This will replace spoken emojis with the
     * corresponding Unicode symbols in the final transcript. If `false`, spoken
     * emojis are not replaced.
     *
     * Generated from protobuf field <code>bool enable_spoken_emojis = 15;</code>
     * @return bool
     */
    public function getEnableSpokenEmojis()
    {
        return $this->enable_spoken_emojis;
    }

    /**
     * The spoken emoji behavior for the call. If `true`, adds spoken emoji
     * formatting for the request. This will replace spoken emojis with the
     * corresponding Unicode symbols in the final transcript. If `false`, spoken
     * emojis are not replaced.
     *
     * Generated from protobuf field <code>bool enable_spoken_emojis = 15;</code>
     * @param bool $var
     * @return $this
     */
    public function setEnableSpokenEmojis($var)
    {
        GPBUtil::checkBool($var);
        $this->enable_spoken_emojis = $var;

        return $this;
    }

    /**
     * Mode for recognizing multi-channel audio.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.RecognitionFeatures.MultiChannelMode multi_channel_mode = 17;</code>
     * @return int
     */
    public function getMultiChannelMode()
    {
        return $this->multi_channel_mode;
    }

    /**
     * Mode for recognizing multi-channel audio.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.RecognitionFeatures.MultiChannelMode multi_channel_mode = 17;</code>
     * @param int $var
     * @return $this
     */
    public function setMultiChannelMode($var)
    {
        GPBUtil::checkEnum($var, \Google\Cloud\Speech\V2\RecognitionFeatures\MultiChannelMode::class);
        $this->multi_channel_mode = $var;

        return $this;
    }

    /**
     * Configuration to enable speaker diarization and set additional
     * parameters to make diarization better suited for your application.
     * When this is enabled, we send all the words from the beginning of the
     * audio for the top alternative in every consecutive STREAMING responses.
     * This is done in order to improve our speaker tags as our models learn to
     * identify the speakers in the conversation over time.
     * For non-streaming requests, the diarization results will be provided only
     * in the top alternative of the FINAL SpeechRecognitionResult.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.SpeakerDiarizationConfig diarization_config = 9;</code>
     * @return \Google\Cloud\Speech\V2\SpeakerDiarizationConfig|null
     */
    public function getDiarizationConfig()
    {
        return $this->diarization_config;
    }

    public function hasDiarizationConfig()
    {
        return isset($this->diarization_config);
    }

    public function clearDiarizationConfig()
    {
        unset($this->diarization_config);
    }

    /**
     * Configuration to enable speaker diarization and set additional
     * parameters to make diarization better suited for your application.
     * When this is enabled, we send all the words from the beginning of the
     * audio for the top alternative in every consecutive STREAMING responses.
     * This is done in order to improve our speaker tags as our models learn to
     * identify the speakers in the conversation over time.
     * For non-streaming requests, the diarization results will be provided only
     * in the top alternative of the FINAL SpeechRecognitionResult.
     *
     * Generated from protobuf field <code>.google.cloud.speech.v2.SpeakerDiarizationConfig diarization_config = 9;</code>
     * @param \Google\Cloud\Speech\V2\SpeakerDiarizationConfig $var
     * @return $this
     */
    public function setDiarizationConfig($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Speech\V2\SpeakerDiarizationConfig::class);
        $this->diarization_config = $var;

        return $this;
    }

    /**
     * Maximum number of recognition hypotheses to be returned.
     * The server may return fewer than `max_alternatives`.
     * Valid values are `0`-`30`. A value of `0` or `1` will return a maximum of
     * one. If omitted, will return a maximum of one.
     *
     * Generated from protobuf field <code>int32 max_alternatives = 16;</code>
     * @return int
     */
    public function getMaxAlternatives()
    {
        return $this->max_alternatives;
    }

    /**
     * Maximum number of recognition hypotheses to be returned.
     * The server may return fewer than `max_alternatives`.
     * Valid values are `0`-`30`. A value of `0` or `1` will return a maximum of
     * one. If omitted, will return a maximum of one.
     *
     * Generated from protobuf field <code>int32 max_alternatives = 16;</code>
     * @param int $var
     * @return $this
     */
    public function setMaxAlternatives($var)
    {
        GPBUtil::checkInt32($var);
        $this->max_alternatives = $var;

        return $this;
    }

}
