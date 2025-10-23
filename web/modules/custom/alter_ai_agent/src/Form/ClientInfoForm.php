<?php

namespace Drupal\alter_ai_agent\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\alter_ai_agent\Service\InternalAIService;

class ClientInfoForm extends FormBase {

  public function getFormId() {
    return 'alter_ai_client_info_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Full Name'),
      '#required' => TRUE,
    ];
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
    ];
    $form['phone'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Phone'),
    ];
    $form['website'] = [
      '#type' => 'url',
      '#title' => $this->t('Website'),
    ];
    $form['social_links'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Social Media Links (comma separated)'),
    ];
    $form['project_details'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Project Details'),
      '#required' => TRUE,
    ];
    $form['marketing_source'] = [
      '#type' => 'textfield',
      '#title' => $this->t('How did you hear about us?'),
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $fields = [
      'name' => $form_state->getValue('name'),
      'email' => $form_state->getValue('email'),
      'phone' => $form_state->getValue('phone'),
      'website' => $form_state->getValue('website'),
      'social_links' => $form_state->getValue('social_links'),
      'project_details' => $form_state->getValue('project_details'),
      'marketing_source' => $form_state->getValue('marketing_source'),
      'created_at' => date('Y-m-d H:i:s'),
    ];

    $conn = \Drupal::database();
    $conn->insert('alter_ai_clients')->fields($fields)->execute();

    // Trigger Internal AI Service
    $ai_service = \Drupal::service('alter_ai_agent.internal_ai');
    $ai_service->processClient($fields);

    \Drupal::messenger()->addMessage($this->t('Thank you! Your project info has been submitted.'));
  }
}
