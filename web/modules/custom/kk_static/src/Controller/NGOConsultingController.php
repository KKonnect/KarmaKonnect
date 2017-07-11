<?php

namespace Drupal\kk_static\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class NGOConsultingController.
 *
 * @package Drupal\kk_static\Controller
 */
class NGOConsultingController extends ControllerBase {

  /**
   * Index.
   *
   * @return string
   *   Return Hello string.
   */
  public function index() {
    return [
      '#theme' => 'ngo_consulting',
      '#attached' => array(
        'library' => array(
          'kk_static/static-pages'
        )
      )
    ];
  }

}
