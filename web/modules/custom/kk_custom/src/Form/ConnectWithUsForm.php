<?php

namespace Drupal\kk_custom\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConnectWithUsForm.
 *
 * @package Drupal\kk_custom\Form
 */
class ConnectWithUsForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'connect_with_us_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['title'] = array(
      '#type' => 'inline_template',
      '#template' => '<h1 class="text-center title title--colored"><span class="title__red">Connect</span> with us</h1>',
    );
    $form['your_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your Name'),
      '#description' => $this->t('Your name'),
      '#attributes' => array('placeholder' => $this->t('Your name')),
      '#maxlength' => 64,
      '#size' => 64,
    ];
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#description' => $this->t('Email'),
      '#attributes' => array('placeholder' => $this->t('Email')),
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('KARMAKONNECT'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    $submit_values = array();
    foreach ($form_state->getValues() as $key => $value) {
      $submit_values[$key] = $value;
      //drupal_set_message($key . ': ' . $value);
    }
    //print '<pre>';print_r($submit_values);exit;
    $mailManager = \Drupal::service('plugin.manager.mail');
    $module = 'kk_custom';
    $key = 'get_in_touch';
    $to = $submit_values['email'];
    $params['message'] = 'Dear ' . $submit_values['your_name'] . ',
Thank you for registering with Karmakonnect. We will be in touch with you shortly.

Meanwhile spread #GoodKarma

With Gratitude,
The Karmakonnect Network';
    $params['headers'] = array(
      'from' => \Drupal::config('system.site')->get('mail'),
      'Bcc' => 'drumi@karmakonnect.in'
    );

    $langcode = \Drupal::currentUser()->getPreferredLangcode();
    $send = TRUE;
    $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);
    if ($result['result'] !== TRUE) {
      drupal_set_message(t('There was a problem sending your message and it was not sent.'), 'error');
    }
    else {
      drupal_set_message('Thanks for connecting with us.');
    }
  }

}
