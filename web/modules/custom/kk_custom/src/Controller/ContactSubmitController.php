<?php

namespace Drupal\kk_custom\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ContactSubmitController.
 *
 * @package Drupal\kk_custom\Controller
 */
class ContactSubmitController extends ControllerBase {

  /**
   * Submit the example_form.
   *
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  public static function contactFormSubmit(&$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    if($values['field_subscribe_to_our_newslette']['value'] == 1) {
      $sub_manager = \Drupal::service('simplenews.subscription_manager');
      $sub_manager->subscribe($values['mail'], 'default');
    }
  }

}
