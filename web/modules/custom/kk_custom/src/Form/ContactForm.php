<?php

namespace Drupal\kk_custom\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\simplenews\Subscription\SubscriptionManager;

/**
 * Class ContactForm.
 *
 * @package Drupal\kk_custom\Form
 */
class ContactForm extends FormBase {

  /**
   * Drupal\simplenews\Subscription\SubscriptionManager definition.
   *
   * @var \Drupal\simplenews\Subscription\SubscriptionManager
   */
  protected $simplenewsSubscriptionManager;
  /**
   * Constructs a new ContactForm object.
   */
  public function __construct(
    SubscriptionManager $simplenews_subscription_manager
  ) {
    $this->simplenewsSubscriptionManager = $simplenews_subscription_manager;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('simplenews.subscription_manager')
    );
  }


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'contact_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['how_can_we_help_you'] = [
      '#type' => 'select',
      '#title' => $this->t('How can we help you?'),
      '#description' => $this->t('Select purpose of Inquiry'),
      '#options' => [
        'General' => $this->t('General'),
        'CSR Consulting' => $this->t('CSR Consulting'),
        'Consulting Services' => $this->t('Consulting Services'),
      ],
    ];
    $form['your_email'] = [
      '#type' => 'email',
      '#title' => $this->t('Your Email'),
      '#description' => $this->t('somename@xyz.com'),
    ];
    $form['phone_number'] = [
      '#type' => 'tel',
      '#title' => $this->t('Phone Number'),
      '#description' => $this->t('+91'),
    ];
    $form['message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Message'),
      '#description' => $this->t('Write brief inquiry here'),
    ];
    $form['subscribe_to_our_newsletter_to_g'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Subscribe to our newsletter to get good karmas'),
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('SUBMIT'),
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
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }

  }

}
