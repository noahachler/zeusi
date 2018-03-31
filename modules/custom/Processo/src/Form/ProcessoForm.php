<?php

namespace Drupal\processo\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

class ProcessoForm extends ContentEntityForm {

  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\processo\Entity\Processo */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;
    return $form;
  }

  
  public function save(array $form, FormStateInterface $form_state) {
    $form_state->setRedirect('entity.processo.views');
    $entity = $this->getEntity();
    $entity->save();
  }
}