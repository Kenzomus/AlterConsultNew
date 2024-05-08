<?php

namespace Drupal\augmentor_nlpcloud\Plugin\Augmentor;

use Drupal\augmentor_nlpcloud\NPLCloudBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * NLP Cloud Translation augmentor plugin implementation.
 *
 * @Augmentor(
 *   id = "augmentor_nlpcloud_translation",
 *   label = @Translation("NLP Cloud Translation"),
 *   description = @Translation("Translate text in 200 languages using
 *   Facebook's NLLB 200 3.3B model. The limit is 250 tokens in synchronous
 *   mode."),
 * )
 */
class NLPCloudTranslation extends NPLCloudBase {

  /**
   * Default NLP Cloud model for translation.
   */
  const NLP_CLOUD_MODEL = 'nllb-200-3-3b';

  /**
   * Default GPU/CPU status: TRUE (use GPU) / FALSE (use CPU).
   */
  const NLP_CLOUD_GPU = FALSE;

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return parent::defaultConfiguration() + [
      'source' => NULL,
      'target' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);

    $form['source'] = [
      '#type' => 'select',
      '#title' => $this->t('Source Language'),
      '#options' => $this->getSupportedLanguages(),
      '#default_value' => $this->configuration['source'] ?? 'eng_Latn',
      '#description' => $this->t('Choose the language of the input text.'),
    ];
    $form['target'] = [
      '#type' => 'select',
      '#title' => $this->t('Target Language'),
      '#options' => $this->getSupportedLanguages(),
      '#default_value' => $this->configuration['target'] ?? 'fra_Latn',
      '#description' => $this->t('Choose the language of the translated text.'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);
    $this->configuration['source'] = $form_state->getValue('source');
    $this->configuration['target'] = $form_state->getValue('target');
  }

  /**
   * Translate o text to another language of the provided input.
   *
   * @param string $text
   *   The text that you want to translate. 250 tokens maximum in
   *   synchronous mode and 1 million tokens maximum in asynchronous mode.
   *
   * @return array
   *   The translation of your text.
   */
  public function execute(string $text): array {
    try {
      $language = trim($this->configuration['language']);
      $source = trim($this->configuration['source']);
      $target = trim($this->configuration['target']);
      $client = $this->getClient(self::NLP_CLOUD_MODEL, self::NLP_CLOUD_GPU, $language);
      $result = $client->translation($text, $source, $target);
      return ['default' => $result->translation_text];
    }
    catch (\Throwable $error) {
      $this->logger->error('NLP Cloud Translation Text error: %message.', [
        '%message' => $error->getMessage(),
      ]);
      return [
        '_errors' => $this->t('Error during the NLP Cloud translation, please check the logs for more information.')->render(),
      ];
    }
  }

  /**
   * Returns the list of supported languages by Translation.
   *
   * @return array
   *   The list of supported languages.
   */
  private function getSupportedLanguages(): array {
    return [
      'ace_Arab' => $this->t('Acehnese (Arabic script)'),
      'ace_Latn' => $this->t('Acehnese (Latin script)'),
      'acm_Arab' => $this->t('Mesopotamian Arabic'),
      'acq_Arab' => $this->t('Ta’izzi-Adeni Arabic'),
      'aeb_Arab' => $this->t('Tunisian Arabic'),
      'afr_Latn' => $this->t('Afrikaans'),
      'ajp_Arab' => $this->t('South Levantine Arabic'),
      'aka_Latn' => $this->t('Akan'),
      'amh_Ethi' => $this->t('Amharic'),
      'apc_Arab' => $this->t('North Levantine Arabic'),
      'arb_Arab' => $this->t('Modern Standard Arabic'),
      'arb_Latn' => $this->t('Modern Standard Arabic (Romanized)'),
      'ars_Arab' => $this->t('Najdi Arabic'),
      'ary_Arab' => $this->t('Moroccan Arabic'),
      'arz_Arab' => $this->t('Egyptian Arabic'),
      'asm_Beng' => $this->t('Assamese'),
      'ast_Latn' => $this->t('Asturian'),
      'awa_Deva' => $this->t('Awadhi'),
      'ayr_Latn' => $this->t('Central Aymara'),
      'azb_Arab' => $this->t('South Azerbaijani'),
      'azj_Latn' => $this->t('North Azerbaijani'),
      'bak_Cyrl' => $this->t('Bashkir'),
      'bam_Latn' => $this->t('Bambara'),
      'ban_Latn' => $this->t('Balinese'),
      'bel_Cyrl' => $this->t('Belarusian'),
      'bem_Latn' => $this->t('Bemba'),
      'ben_Beng' => $this->t('Bengali'),
      'bho_Deva' => $this->t('Bhojpuri'),
      'bjn_Arab' => $this->t('Banjar (Arabic script)'),
      'bjn_Latn' => $this->t('Banjar (Latin script)'),
      'bod_Tibt' => $this->t('Standard Tibetan'),
      'bos_Latn' => $this->t('Bosnian'),
      'bug_Latn' => $this->t('Buginese'),
      'bul_Cyrl' => $this->t('Bulgarian'),
      'cat_Latn' => $this->t('Catalan'),
      'ceb_Latn' => $this->t('Cebuano'),
      'ces_Latn' => $this->t('Czech'),
      'cjk_Latn' => $this->t('Chokwe'),
      'ckb_Arab' => $this->t('Central Kurdish'),
      'crh_Latn' => $this->t('Crimean Tatar'),
      'cym_Latn' => $this->t('Welsh'),
      'dan_Latn' => $this->t('Danish'),
      'deu_Latn' => $this->t('German'),
      'dik_Latn' => $this->t('Southwestern Dinka'),
      'dyu_Latn' => $this->t('Dyula'),
      'dzo_Tibt' => $this->t('Dzongkha'),
      'ell_Grek' => $this->t('Greek'),
      'eng_Latn' => $this->t('English'),
      'epo_Latn' => $this->t('Esperanto'),
      'est_Latn' => $this->t('Estonian'),
      'eus_Latn' => $this->t('Basque'),
      'ewe_Latn' => $this->t('Ewe'),
      'fao_Latn' => $this->t('Faroese'),
      'fij_Latn' => $this->t('Fijian'),
      'fin_Latn' => $this->t('Finnish'),
      'fon_Latn' => $this->t('Fon'),
      'fra_Latn' => $this->t('French'),
      'fur_Latn' => $this->t('Friulian'),
      'fuv_Latn' => $this->t('Nigerian Fulfulde'),
      'gla_Latn' => $this->t('Scottish Gaelic'),
      'gle_Latn' => $this->t('Irish'),
      'glg_Latn' => $this->t('Galician'),
      'grn_Latn' => $this->t('Guarani'),
      'guj_Gujr' => $this->t('Gujarati'),
      'hat_Latn' => $this->t('Haitian Creole'),
      'hau_Latn' => $this->t('Hausa'),
      'heb_Hebr' => $this->t('Hebrew'),
      'hin_Deva' => $this->t('Hindi'),
      'hne_Deva' => $this->t('Chhattisgarhi'),
      'hrv_Latn' => $this->t('Croatian'),
      'hun_Latn' => $this->t('Hungarian'),
      'hye_Armn' => $this->t('Armenian'),
      'ibo_Latn' => $this->t('Igbo'),
      'ilo_Latn' => $this->t('Ilocano'),
      'ind_Latn' => $this->t('Indonesian'),
      'isl_Latn' => $this->t('Icelandic'),
      'ita_Latn' => $this->t('Italian'),
      'jav_Latn' => $this->t('Javanese'),
      'jpn_Jpan' => $this->t('Japanese'),
      'kab_Latn' => $this->t('Kabyle'),
      'kac_Latn' => $this->t('Jingpho'),
      'kam_Latn' => $this->t('Kamba'),
      'kan_Knda' => $this->t('Kannada'),
      'kas_Arab' => $this->t('Kashmiri (Arabic script)'),
      'kas_Deva' => $this->t('Kashmiri (Devanagari script)'),
      'kat_Geor' => $this->t('Georgian'),
      'knc_Arab' => $this->t('Central Kanuri (Arabic script)'),
      'knc_Latn' => $this->t('Central Kanuri (Latin script)'),
      'kaz_Cyrl' => $this->t('Kazakh'),
      'kbp_Latn' => $this->t('Kabiyè'),
      'kea_Latn' => $this->t('Kabuverdianu'),
      'khm_Khmr' => $this->t('Khmer'),
      'kik_Latn' => $this->t('Kikuyu'),
      'kin_Latn' => $this->t('Kinyarwanda'),
      'kir_Cyrl' => $this->t('Kyrgyz'),
      'kmb_Latn' => $this->t('Kimbundu'),
      'kmr_Latn' => $this->t('Northern Kurdish'),
      'kon_Latn' => $this->t('Kikongo'),
      'kor_Hang' => $this->t('Korean'),
      'lao_Laoo' => $this->t('Lao'),
      'lij_Latn' => $this->t('Ligurian'),
      'lim_Latn' => $this->t('Limburgish'),
      'lin_Latn' => $this->t('Lingala'),
      'lit_Latn' => $this->t('Lithuanian'),
      'lmo_Latn' => $this->t('Lombard'),
      'ltg_Latn' => $this->t('Latgalian'),
      'ltz_Latn' => $this->t('Luxembourgish'),
      'lua_Latn' => $this->t('Luba-Kasai'),
      'lug_Latn' => $this->t('Ganda'),
      'luo_Latn' => $this->t('Luo'),
      'lus_Latn' => $this->t('Mizo'),
      'lvs_Latn' => $this->t('Standard Latvian'),
      'mag_Deva' => $this->t('Magahi'),
      'mai_Deva' => $this->t('Maithili'),
      'mal_Mlym' => $this->t('Malayalam'),
      'mar_Deva' => $this->t('Marathi'),
      'min_Arab' => $this->t('Minangkabau (Arabic script)'),
      'min_Latn' => $this->t('Minangkabau (Latin script)'),
      'mkd_Cyrl' => $this->t('Macedonian'),
      'plt_Latn' => $this->t('Plateau Malagasy'),
      'mlt_Latn' => $this->t('Maltese'),
      'mni_Beng' => $this->t('Meitei (Bengali script)'),
      'khk_Cyrl' => $this->t('Halh Mongolian'),
      'mos_Latn' => $this->t('Mossi'),
      'mri_Latn' => $this->t('Maori'),
      'mya_Mymr' => $this->t('Burmese'),
      'nld_Latn' => $this->t('Dutch'),
      'nno_Latn' => $this->t('Norwegian Nynorsk'),
      'nob_Latn' => $this->t('Norwegian Bokmål'),
      'npi_Deva' => $this->t('Nepali'),
      'nso_Latn' => $this->t('Northern Sotho'),
      'nus_Latn' => $this->t('Nuer'),
      'nya_Latn' => $this->t('Nyanja'),
      'oci_Latn' => $this->t('Occitan'),
      'gaz_Latn' => $this->t('West Central Oromo'),
      'ory_Orya' => $this->t('Odia'),
      'pag_Latn' => $this->t('Pangasinan'),
      'pan_Guru' => $this->t('Eastern Panjabi'),
      'pap_Latn' => $this->t('Papiamento'),
      'pes_Arab' => $this->t('Western Persian'),
      'pol_Latn' => $this->t('Polish'),
      'por_Latn' => $this->t('Portuguese'),
      'prs_Arab' => $this->t('Dari'),
      'pbt_Arab' => $this->t('Southern Pashto'),
      'quy_Latn' => $this->t('Ayacucho Quechua'),
      'ron_Latn' => $this->t('Romanian'),
      'run_Latn' => $this->t('Rundi'),
      'rus_Cyrl' => $this->t('Russian'),
      'sag_Latn' => $this->t('Sango'),
      'san_Deva' => $this->t('Sanskrit'),
      'sat_Olck' => $this->t('Santali'),
      'scn_Latn' => $this->t('Sicilian'),
      'shn_Mymr' => $this->t('Shan'),
      'sin_Sinh' => $this->t('Sinhala'),
      'slk_Latn' => $this->t('Slovak'),
      'slv_Latn' => $this->t('Slovenian'),
      'smo_Latn' => $this->t('Samoan'),
      'sna_Latn' => $this->t('Shona'),
      'snd_Arab' => $this->t('Sindhi'),
      'som_Latn' => $this->t('Somali'),
      'sot_Latn' => $this->t('Southern Sotho'),
      'spa_Latn' => $this->t('Spanish'),
      'als_Latn' => $this->t('Tosk Albanian'),
      'srd_Latn' => $this->t('Sardinian'),
      'srp_Cyrl' => $this->t('Serbian'),
      'ssw_Latn' => $this->t('Swati'),
      'sun_Latn' => $this->t('Sundanese'),
      'swe_Latn' => $this->t('Swedish'),
      'swh_Latn' => $this->t('Swahili'),
      'szl_Latn' => $this->t('Silesian'),
      'tam_Taml' => $this->t('Tamil'),
      'tat_Cyrl' => $this->t('Tatar'),
      'tel_Telu' => $this->t('Telugu'),
      'tgk_Cyrl' => $this->t('Tajik'),
      'tgl_Latn' => $this->t('Tagalog'),
      'tha_Thai' => $this->t('Thai'),
      'tir_Ethi' => $this->t('Tigrinya'),
      'taq_Latn' => $this->t('Tamasheq (Latin script)'),
      'taq_Tfng' => $this->t('Tamasheq (Tifinagh script)'),
      'tpi_Latn' => $this->t('Tok Pisin'),
      'tsn_Latn' => $this->t('Tswana'),
      'tso_Latn' => $this->t('Tsonga'),
      'tuk_Latn' => $this->t('Turkmen'),
      'tum_Latn' => $this->t('Tumbuka'),
      'tur_Latn' => $this->t('Turkish'),
      'twi_Latn' => $this->t('Twi'),
      'tzm_Tfng' => $this->t('Central Atlas Tamazight'),
      'uig_Arab' => $this->t('Uyghur'),
      'ukr_Cyrl' => $this->t('Ukrainian'),
      'umb_Latn' => $this->t('Umbundu'),
      'urd_Arab' => $this->t('Urdu'),
      'uzn_Latn' => $this->t('Northern Uzbek'),
      'vec_Latn' => $this->t('Venetian'),
      'vie_Latn' => $this->t('Vietnamese'),
      'war_Latn' => $this->t('Waray'),
      'wol_Latn' => $this->t('Wolof'),
      'xho_Latn' => $this->t('Xhosa'),
      'ydd_Hebr' => $this->t('Eastern Yiddish'),
      'yor_Latn' => $this->t('Yoruba'),
      'yue_Hant' => $this->t('Yue Chinese'),
      'zho_Hans' => $this->t('Chinese (Simplified)'),
      'zho_Hant' => $this->t('Chinese (Traditional)'),
      'zsm_Latn' => $this->t('Standard Malay'),
      'zul_Latn' => $this->t('Zulu'),
    ];
  }

}
