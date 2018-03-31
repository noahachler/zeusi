<?php

namespace Drupal\processo\Form;

use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * @ingroup processo
 */
class InterventoDeleteForm extends ContentEntityConfirmFormBase {

  public function getQuestion() {
    return $this->t('Sicuro di voler eliminare %nome ?', ['%nome' => $this->entity->nome->value]);
  }

  public function getCancelUrl() {
    return new Url('entity.intervento.views');
  }

  public function getConfirmText() {
    return $this->t('Delete');
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $entity->delete();

    $this->logger('intervento')->notice('@type: deleted %nome.',
      [
        '@type' => $this->entity->bundle(),
        '%title' => $this->entity->nome->value,
      ]);
    $form_state->setRedirect('entity.intervento.views');
  }
}