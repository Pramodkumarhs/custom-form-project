<?php

namespace Drupal\timezone\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a Timezone Block.
 *
 * @Block(
 *   id = "timezone_block",
 *   admin_label = @Translation("Timezone Block"),
 * )
 */

class TimezoneBlock extends BlockBase
{

  /**
   * {@inheritdoc}
   */
  public function build() {
    
	$value=$this->getTimeContent();
return [
      '#theme' => 'timezone_block',
      '#data' => $value,
    ];
 }
  
  public function getTimeContent()
  {
    $config = \Drupal::config('timezone.settings');
    $get_selected_country = $config->get('Country_name');

    $service = \Drupal::service('timezone.say_hello');
    $array = array("Time"=> $service->sayHello(), "Location"=> $get_selected_country);
    return $array;
  }
}