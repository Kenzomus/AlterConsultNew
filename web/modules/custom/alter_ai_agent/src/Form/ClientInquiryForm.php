<?php

namespace Drupal\alter_ai_agent\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\alter_ai_agent\Service\OpenAIService;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ClientInquiryForm extends FormBase {

  protected OpenAIService $aiService;

  public function __construct(OpenAIService $aiService) {
    $this->aiService = $aiService;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('alter_ai_agent.openai_service')
    );
  }

  public function getFormId(): string {
    return 'alter_ai_client_inquiry_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
    ];

    $form['project_details'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Project Details'),
      '#required' => TRUE,
    ];

    $form['marketing_info'] = [
      '#type' => 'select',
      '#title' => $this->t('How did you hear about us?'),
      '#options' => [
        'social_media' => $this->t('Social Media'),
        'referral' => $this->t('Referral'),
        'search' => $this->t('Search Engine'),
        'other' => $this->t('Other'),
      ],
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $name = $form_state->getValue('name');
    $email = $form_state->getValue('email');
    $project = $form_state->getValue('project_details');
    $marketing = $form_state->getValue('marketing_info');

    // Prepare AI prompt.
    $prompt = "You are a professional consultant. The client project description: $project.
    Client Name: $name, Email: $email. Marketing source: $marketing.
    Provide a project estimate and advice for positioning Alter Consult in USA and Senegal.";

    $ai_response = $this->aiService->askAI($prompt);

    \Drupal::messenger()->addMessage($this->t('AI Response: @response', ['@response' => $ai_response]));

    // Optionally, save to a custom table for analytics.
  }
}
