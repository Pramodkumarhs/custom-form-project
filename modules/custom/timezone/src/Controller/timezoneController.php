<?php
/**
 * @file
 * @author 
 * Contains \Drupal\timezone\Controller\timezoneController.
 * Please place this file under your example(module_root_folder)/src/Controller/
 */
namespace Drupal\timezone\Controller;
/**
 * Provides route responses for the Example module.
 */
class timezoneController {
  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function myPage() {
    $form['Country_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Country name:'),
      '#required' => TRUE,
    );
    $form['city'] = array(
      '#type' => 'textfield',
      '#title' => t('city:'),
      '#required' => TRUE,
    );
    $form['Timezone'] = array (
      '#type' => 'select',
      '#title' => t('timezone'),
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
    return $form;
  }
}
?>