<?php

/**
* @file providing the service that say hello world and hello 'given name'.
*
*/

namespace  Drupal\timezone;

class TimeServices {

 protected $say_something;

 public function __construct() {
   $this->say_something = 'Hello World!';
 }

 public function  sayHello(){
    $config = \Drupal::config('timezone.settings');
    $get_selected_timezone = $config->get('Timezone');
    $date = new \DateTime("now", new \DateTimeZone($get_selected_timezone) );
    return $date->format('d-M-Y H:i A');
   
 }

}