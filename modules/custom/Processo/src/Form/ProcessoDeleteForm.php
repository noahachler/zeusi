<?php

namespace Drupal\processo\Form;

use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * @ingroup processo
 */
class ProcessoDeleteForm extends ContentEntityConfirmFormBase {

  public function getQuestion() {
    return $this->t('Sicuro di voler eliminare %name ?', ['%name' => $this->entity->label()]);
  }

  public function getCancelUrl() {
    return new Url('entity.processo.views');
  }

  public function getConfirmText() {
    return $this->t('Delete');
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $entity->delete();

    $this->logger('processo')->notice('@type: deleted %title.',
      [
        '@type' => $this->entity->bundle(),
        '%title' => $this->entity->label(),
      ]);
    $form_state->setRedirect('entity.processo.views');
  }
}