<?php

namespace Drupal\processo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class InterventoSettingsForm extends FormBase {

  public function getFormId() {
    return 'intervento_settings';
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['intervento_settings']['#markup'] = 'Settings form for Intervento. Manage field settings here.';
    return $form;
  }
}