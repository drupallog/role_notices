<?php

namespace Drupal\role_notices\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class RoleNoticesSettingForm.
 *
 * @package Drupal\role_notices\Form
 */
class RoleNoticesSettingsForm extends FormBase {

  protected $NoticesManger;

  /**
  * Class constructor
  *
  * @param \Drupal\role_notices\NoticesManger $notices_manager
  * The notices manager for getting and setting notices
  */
  public function __construct(NoticesManger $notices_manager) {
    $this->NoticesManger = $notices_manager;
  }

  public static function create(ContainerInterface $container) {
    return new static(
    $container->get('role_notices.notices_manager')
  );
  }
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'role_notices_setting_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $role_names = user_role_names(TRUE);
    $form['role_notices_notices']  = array(
      '#tree' => TRUE,
    );
    $notices_manager = new NoticesManger();
    $notices = $notices_manager->gerAllNotices();
    //create text area for each role.
    foreach ($role_names as $role_id => $role_name) {
      # code...
      $form['role_notices_notices'][$role_id] = array(
        '#type' => 'textarea',
        '#title' => $role_name,
        '#description' => $this->t('Add a notice for the !role role', array('!role' => "<strong>$role_name</strong>")),
        '#default_values' => isset($notices[$role_id]) ? $notices[$role_id] : '',
      );
    }
    $form['action']  = array('#type' => 'actions');
    $form['action']['submit']  = array(
      '#type' => 'submit',
      '#value' => $this->t('Save Text settings'),
     );
    return $form;
  }

  /**
   * Form submission handler.
   * @param array $form_state
   *  An associative array containing the structure of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $form_values = $form_state->getValues();
    $notices_manager = new NoticesManger(\Drupal::current_user(), \Drupal::state());
    $this->notices_manager->setAllNotices($form_values['role_notices_notices']);
    drupal_set_message($this->t('The notices have been saved.'));
  }

}
