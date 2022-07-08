<?php

namespace Drupal\custom_timezone\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\custom_timezone\GetCurrentTime;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Timezone display Block'.
 *
 * @Block(
 *   id = "timezone_block",
 *   admin_label = @Translation("Block that displays current time and timezone")
 * )
 */
class TimezoneBlock extends BlockBase implements ContainerFactoryPluginInterface {
  /**
   * Timezone service.
   *
   * @var time
   */
  protected $time = NULL;

  /**
   * Static create function provided by the ContainerFactoryPluginInterface.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('custom_timezone.getTime')
    );
  }

  /**
   * BlockBase plugin constructor expect GetCurrentTime object givenby create().
   *
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, GetCurrentTime $time) {
    // Instantiate the BlockBase parent.
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    // Save the service passed to this constructor via dependency injection.
    $this->time = $time;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $timezone = \Drupal::config('custom_timezone.settings')->get('timezone');
    if ($timezone == 'none' || is_null($timezone) == TRUE) {
      $timezone = 'Timezone not configured in this site !';
    }
    // Disable cache for anonymous users.
    \Drupal::service('page_cache_kill_switch')->trigger();
    $renderable = [
      '#theme' => 'timezone_template',
      '#timezone' => $timezone,
      '#current_time' => $this->time->getTime(),
      '#attached' => [
        'library' => [
          'custom_timezone/global-styling',
        ],
      ],
    ];

    return $renderable;
  }

  /**
   * {@inheritdoc}
   *
   * Return 0 If you want to disable caching for this block.
   */
  public function getCacheMaxAge() {
    return 0;
  }

}
