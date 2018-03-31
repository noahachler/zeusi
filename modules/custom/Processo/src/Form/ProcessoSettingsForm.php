<?php

namespace Drupal\processo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ProcessoSettingsForm extends FormBase {

  public function getFormId() {
    return 'processo_settings';
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['processo_settings']['#markup'] = 'Settings form for Processo. Manage field settings here.';
    return $form;
  }
}