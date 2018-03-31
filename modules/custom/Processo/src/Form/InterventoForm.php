<?php

namespace Drupal\processo\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

class InterventoForm extends ContentEntityForm {

  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\processo\Entity\Intervento */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;
    return $form;
  }

  public function save(array $form, FormStateInterface $form_state) {
    $form_state->setRedirect('entity.intervento.views');
    $entity = $this->getEntity();
    $entity->save();
  }
}