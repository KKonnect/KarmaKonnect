<?php

namespace Drupal\kk_custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'ContactBlock' block.
 *
 * @Block(
 *  id = "contact_block",
 *  admin_label = @Translation("Contact block"),
 * )
 */
class ContactBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['contact-block']['form'][] = \Drupal::formBuilder()->getForm('\Drupal\kk_custom\Form\ContactForm');
    return $build;
  }

}
