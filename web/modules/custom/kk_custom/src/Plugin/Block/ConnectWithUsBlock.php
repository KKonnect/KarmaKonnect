<?php

namespace Drupal\kk_custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'ConnectWithUsBlock' block.
 *
 * @Block(
 *  id = "connect_with_us_block",
 *  admin_label = @Translation("CONNECT WITH US"),
 * )
 */
class ConnectWithUsBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['connect-with-us']['form'][] = \Drupal::formBuilder()->getForm('\Drupal\kk_custom\Form\ConnectWithUsForm');
    return $build;
  }

}
