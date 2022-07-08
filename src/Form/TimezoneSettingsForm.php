<?php

namespace Drupal\custom_timezone\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class TimezoneSettingsForm for setting up the timezone config form.
 */
class TimezoneSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'custom_timezone.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'timezone_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('custom_timezone.settings');
    // Attaching the libraries to this form.
    $form['#attached']['library'][] = 'timezone_theme/global-styling';
    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $config->get('country'),
      '#size' => 70,
      '#maxlength' => 130,
    ];
    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('CIty'),
      '#default_value' => $config->get('city'),
      '#size' => 70,
      '#maxlength' => 130,
    ];
    $form['timezone'] = [
      '#type' => 'select',
      '#title' => $this->t('Select TimeZone'),
      '#options' => [
        'none' => t('--Select Timezone--'),
        'America/Chicago' => t('America/Chicago'),
        'America/New_York' => t('America/New_York'),
        'Asia/Tokyo' => t('Asia/Tokyo'),
        'Asia/Dubai' => t('Asia/Dubai'),
        'Asia/Kolkata' => t('Asia/Kolkata'),
        'Europe/Amsterdam' => t('Europe/Amsterdam'),
        'Europe/Oslo' => t('Europe/Oslo'),
        'Europe/London' => t('Europe/London'),
      ],
      '#default_value' => (!empty($config->get('timezone')) ? $config->get('timezone') : 'none'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $this->config('custom_timezone.settings')
      ->set('city', $form_state->getValue('city'))
      ->set('country', $form_state->getValue('country'))
      ->set('timezone', $form_state->getValue('timezone'))
      ->save();
  }

}
