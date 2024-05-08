<?php

namespace Drupal\augmentor_nlpcloud\Plugin\Augmentor;

use Drupal\augmentor_nlpcloud\NPLCloudBase;
use Drupal\Core\Entity\ContentEntityType;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Entity\EntityTypeBundleInfo;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\key\KeyRepositoryInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\File\FileSystemInterface;
use Drupal\file\FileRepositoryInterface;

/**
 * NLP Cloud Classification augmentor plugin implementation.
 *
 * @Augmentor(
 *   id = "augmentor_nlpcloud_classification",
 *   label = @Translation("NLP Cloud Classification"),
 *   description = @Translation("Send a piece of text, and let the AI apply the
 *   right categories to your text, in many languages. As an option, you can
 *   suggest the potential categories you want to assess. We are using Joe
 *   Davison's Bart Large MNLI Yahoo Answers, Joe Davison's XLM Roberta Large
 *   XNLI, and GPT for classification in 100 languages with PyTorch, Jax, and
 *   Hugging Face transformers. You can also use your own model. For
 *   classification without potential categories, use GPT-J/GPT-NeoX."),
 * )
 */
class NLPCloudClassification extends NPLCloudBase {

  /**
   * Default GPU/CPU status: TRUE (use GPU) / FALSE (use CPU).
   */
  const NLP_CLOUD_GPU = FALSE;

  /**
   * The entity type bundle info.
   *
   * @var \Drupal\Core\Entity\EntityTypeBundleInfo
   */
  protected $entityTypeBundleInfo;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * {@inheritdoc}
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    LoggerInterface $logger,
    KeyRepositoryInterface $key_repository,
    AccountInterface $current_user,
    FileSystemInterface $file_system,
    FileRepositoryInterface $file_repository,
    EntityTypeBundleInfo $entity_bundle_info,
    EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $logger, $key_repository, $current_user, $file_system, $file_repository);
    $this->entityTypeBundleInfo = $entity_bundle_info;
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition, MigrationInterface $migration = NULL) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('logger.factory')->get('augmentor'),
      $container->get('key.repository'),
      $container->get('current_user'),
      $container->get('file_system'),
      $container->get('file.repository'),
      $container->get('entity_type.bundle.info'),
      $container->get('entity_type.manager'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return parent::defaultConfiguration() + [
      'model' => NULL,
      'entity_type' => NULL,
      'bundle' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);

    $form['model'] = [
      '#type' => 'select',
      '#title' => $this->t('Model'),
      '#options' => $this->getSupportedModels(),
      '#default_value' => $this->configuration['model'] ?? 'bart-large-mnli-yahoo-answers',
      '#description' => $this->t('Specifies the model which you want to use for Classification.'),
    ];
    $default_entity_type = $this->configuration['entity_type'] ?? 'block_content';
    $form['entity_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Entity type'),
      '#options' => $this->getSupportedEntityTypes(),
      '#default_value' => $default_entity_type,
      '#description' => $this->t('Specifies the entity type which you want to use to get the bundles.'),
      '#required' => TRUE,
      '#ajax' => [
        'callback' => [
          $this,
          '\Drupal\augmentor_nlpcloud\Plugin\Augmentor\NLPCloudClassification::reloadBundle',
        ],
        'event' => 'change',
        'wrapper' => 'bundle-field-wrapper',
      ],
    ];
    $bundles = $this->entityTypeBundleInfo->getBundleInfo($default_entity_type);
    $bundle_options = array_map(function ($item) {
      return $item['label'];
    }, $bundles);
    $form['bundle'] = [
      '#type' => 'select',
      '#title' => $this->t('Bundle'),
      '#options' => $bundle_options,
      '#default_value' => $this->configuration['bundle'] ?? '',
      '#description' => $this->t('Specifies the bundle which you want to use.'),
      '#required' => TRUE,
      '#validated' => TRUE,
      '#prefix' => '<div id="bundle-field-wrapper">',
      '#suffix' => '</div>',
    ];
    $form['threshold'] = [
      '#type' => 'number',
      '#title' => $this->t('Threshold'),
      '#default_value' => $this->configuration['threshold'] ?? 0.9,
      '#min' => 0,
      '#max' => 1,
      '#step' => '.01',
      '#required' => TRUE,
      '#description' => $this->t('Filter out items which have a lower score.'),
    ];
    $form['max_labels_limit'] = [
      '#type' => 'number',
      '#title' => $this->t('Maximum number of labels you want to use to classify your text.'),
      '#default_value' => $this->configuration['max_labels_limit'] ?? 10,
      '#min' => 1,
      '#max' => 10,
      '#required' => TRUE,
      '#description' => $this->t('Use this to specify the maximum number of labels you want to use to classify your text. 10 labels maximum.'),
    ];
    $form['no_result'] = [
      '#type' => 'textarea',
      '#title' => $this->t('No result Output.'),
      '#default_value' => $this->configuration['no_result'] ?? $this->t('No result found.'),
      '#required' => TRUE,
      '#description' => $this->t('Use this to specify the show the text when no result found.'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function reloadBundle(array &$form, FormStateInterface $form_state) {
    $bundles = $this->entityTypeBundleInfo->getBundleInfo($form_state->getValue('settings')['entity_type']);
    $bundle_options = array_map(function ($item) {
      return $item['label'];
    }, $bundles);
    $form['settings']['bundle']['#options'] = $bundle_options;
    return $form['settings']['bundle'];
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);
    $this->configuration['model'] = $form_state->getValue('model');
    $this->configuration['entity_type'] = $form_state->getValue('entity_type');
    $this->configuration['bundle'] = $form_state->getValue('bundle');
    $this->configuration['threshold'] = $form_state->getValue('threshold');
    $this->configuration['max_labels_limit'] = $form_state->getValue('max_labels_limit');
    $this->configuration['no_result'] = $form_state->getValue('no_result');
  }

  /**
   * Extracts summary from the provided input text.
   *
   * @param string $text
   *   The block of text that you want to summarize.
   *   1024 tokens maximum.
   *
   * @return array
   *   The summary of your text.
   */
  public function execute(string $text): array {
    try {
      $language = trim($this->configuration['language']);
      $model = trim($this->configuration['model']);
      $entity_type = trim($this->configuration['entity_type']);
      $bundle = trim($this->configuration['bundle']);
      $max_labels_limit = $this->configuration['max_labels_limit'];
      $labels = $this->getBundleLabels($entity_type, $bundle, $max_labels_limit);
      $client = $this->getClient($model, self::NLP_CLOUD_GPU, $language);
      $result = $client->classification($text, $labels, TRUE);
      return ['default' => $this->getLabelsFromResult($result, $this->configuration['threshold'])];
    }
    catch (\Throwable $error) {
      $this->logger->error('NLP Cloud classification error: %message.', [
        '%message' => $error->getMessage(),
      ]);
      return [
        '_errors' => $this->t('Error during the NLP Cloud classification, please check the logs for more information.')->render(),
      ];
    }
  }

  /**
   * Returns the list of labels filtered based on threshold.
   *
   * @param object $result
   *   The result returned by the NLP Cloud Classification API.
   * @param float $threshold
   *   The threshold to filter the results.
   *
   * @return array
   *   The list of labels.
   */
  private function getLabelsFromResult(object $result, float $threshold): array {
    $labels = $result->labels;
    $scores = $result->scores;
    $output = [];
    foreach ($labels as $key => $label) {
      if ($scores[$key] > $threshold) {
        $output[] = $label;
      }
    }
    if (empty($output)) {
      $output[] = $this->configuration['no_result'];
    }
    return $output;
  }

  /**
   * Returns the list of supported models by Classification.
   *
   * @return array
   *   With the list of supported models.
   */
  private function getSupportedModels(): array {
    return [
      'bart-large-mnli-yahoo-answers' => $this->t("Joe Davison's Bart Large MNLI Yahoo Answers"),
      'xlm-roberta-large-xnli' => $this->t("Joe Davison's XLM Roberta Large XNLI"),
      'fast-gpt-j' => $this->t('Fast GPT-J'),
      'finetuned-gpt-neox-20b' => $this->t('Finetuned GPT-NeoX 20B'),
    ];
  }

  /**
   * Returns the list of supported entity types.
   *
   * @return array
   *   The list of supported entity types.
   */
  private function getSupportedEntityTypes(): array {
    $entity_definitions = $this->entityTypeManager->getDefinitions();
    $entity_types = [];
    foreach ($entity_definitions as $entity_name => $entity_definition) {
      if ($entity_definition instanceof ContentEntityType && $entity_definition->getBundleEntityType()) {
        $entity_types[$entity_name] = (string) $entity_definition->getLabel();
      }
    }
    return $entity_types;
  }

  /**
   * Returns the list of labels of a bundle.
   *
   * @param string $entity_type
   *   The entity type.
   * @param string $bundle
   *   The bundle name.
   * @param int $max_limit
   *   The maximum limit of the results.
   *
   * @return array
   *   The list of labels.
   */
  private function getBundleLabels(string $entity_type, string $bundle, int $max_limit): array {
    $entity_storage = $this->entityTypeManager->getStorage($entity_type);
    $bundle_key = $entity_storage->getEntityType()->getKey('bundle');
    $entity_query = $entity_storage->getQuery();
    $entity_query->condition($bundle_key, $bundle);
    if ($entity_storage->getEntityType()->getKey('published')) {
      $entity_query->condition('status', 1);
    }
    $entity_query->range(0, $max_limit);
    $entity_query->accessCheck(TRUE);
    $entity_ids = $entity_query->execute();
    $entities = $entity_storage->loadMultiple($entity_ids);
    $labels = [];
    foreach ($entities as $entity) {
      $labels[] = $entity->label();
    }
    return $labels;
  }

}
