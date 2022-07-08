<?php

namespace Drupal\custom_timezone;

/**
 * File providing the service that return current time based on timezone.
 */
class GetCurrentTime {
  /**
   * To return the current time.
   *
   * @var time
   */
  protected $time;

  /**
   * GetCurrentTime constructor.
   */
  public function __construct() {
    $this->time = 'Time will display only when the Timezone is set !';
  }

  /**
   * Function to get the current time based on the timezone.
   */
  public function getTime() {
    // Get the timezone config value.
    $config = \Drupal::config('custom_timezone.settings');
    $timezone = $config->get('timezone');
    if ($timezone != 'none' && is_null($timezone) != TRUE) {
      $date = new \DateTime(NULL, new \DateTimeZone($timezone));
      // Convert the current time to the given format.
      $date = $date->format('jS M Y - g:i A');
      $this->time = $date;
    }
    return $this->time;
  }

}
