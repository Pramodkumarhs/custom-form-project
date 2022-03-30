<?php

/**
 * @file
 * Contains \Drupal\custom\Form\ModuleConfigurationForm
 */
namespace Drupal\timezone\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures forms module settings.
 */
class ModuleConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'timezone_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'timezone.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('timezone.settings');
   $form['Country_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Country name:'),
      '#required' => TRUE,
      '#default_value' => $config->get('Country_name'),
    );
    $form['city'] = array(
      '#type' => 'textfield',
      '#title' => t('city:'),
      '#required' => TRUE,
      '#default_value' => $config->get('city'),
    );
    $form['Timezone'] = array (
      '#type' => 'select',
      '#title' => t('timezone'),
      '#default_value' => $config->get('Timezone'),
      '#options' => array(
      'America/Chicago' => t('America/Chicago'),
      'America/New_York' => t('America/New_York'),
      'Asia/Tokyo' => t('Asia/Tokyo'),
      'Asia/Dubai' => t('Asia/Dubai'),
      'Asia/Kolkata' => t('Asia/Kolkata'),
      'Europe/Amsterdam' => t('Europe/Amsterdam'),
      'Europe/Oslo' => t('Europe/Oslo'),
      'Europe/London' => t('Europe/London'),
      ),
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Generate Timezone '),
      '#button_type' => 'primary',
    );
	
    //$select = db_select('node_field_data', 'm');
	  $connection = \Drupal::service('database');
    $select = $connection->select('node_field_data', 'm');
    $select->fields('m',array('nid', 'title'));
    $value=$select->execute()->fetchAll();
	
    
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->configFactory->getEditable('timezone.settings')
      ->set('Country_name', $form_state->getValue('Country_name'))
	  ->set('city', $form_state->getValue('city'))
    ->set('Timezone', $form_state->getValue('Timezone'))
      ->save();

	  $connection = \Drupal::service('database');
    $select = $connection->select('node_field_data', 'm');
    $select->fields('m',array('nid', 'title'));
    $value=$select->execute()->fetchAll();
    foreach ($value as $row) {
      $this->configFactory->getEditable('timezone.settings')
        ->set(strtolower(str_replace(' ', '_', $row->title)), $form_state->getValue(strtolower(str_replace(' ', '_', $row->title))))
        ->save();
    }
    parent::submitForm($form, $form_state);
  }

}