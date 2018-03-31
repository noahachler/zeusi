<?php
namespace Drupal\processo\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\processo\ProcessoInterface;
use Drupal\user\UserInterface;
use Drupal\Core\Entity\EntityChangedTrait;

/**
 *
 * @ingroup processo
 *
 * @ContentEntityType(
 * id = "processo",
 * label = @Translation("Processo entity"),
 * handlers = {
 * "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 * "list_builder" = "Drupal\processo\Entity\Controller\ProcessoListBuilder",
 * "form" = {
 * "add" = "Drupal\processo\Form\ProcessoForm",
 * "edit" = "Drupal\processo\Form\ProcessoForm",
 * "delete" = "Drupal\processo\Form\ProcessoDeleteForm",
 * },
 * "access" = "Drupal\processo\ProcessoAccessControlHandler",
 * },
 * list_cache_contexts = { "user" },
 * base_table = "zeusi.processo",
 * admin_permission = "administer processo entity",
 * entity_keys = {
 * "id" = "id",
 * "uuid" = "uuid",
 * "label" = "title"
 * },
 * links = {
 * "canonical" = "/processo/{processo}",
 * "edit-form" = "/processo/{processo}/edit",
 * "delete-form" = "/processo/{processo}/delete",
 * "collection" = "/processo/list"
 * },
 * field_ui_base_route = "processo.processo_settings",
 * )
 *
 */
class Processo extends ContentEntityBase implements ProcessoInterface
{

  use EntityChangedTrait;


  public static function preCreate(EntityStorageInterface $storage_controller, array &$values)
  {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id()
    ];
  }

  public function getCreatedTime()
  {
    return $this->get('created')->value;
  }

  public function getChangedTime()
  {
    return $this->get('changed')->value;
  }

  public function getOwner()
  {
    return $this->get('user_id')->entity;
  }

  public function getOwnerId()
  {
    return $this->get('user_id')->target_id;
  }

  public function setOwnerId($uid)
  {
    $this->set('user_id', $uid);
    return $this;
  }

  public function setOwner(UserInterface $account)
  {
    $this->set('user_id', $account->id());
    return $this;
  }

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
  {
    $fields['id'] = BaseFieldDefinition::create('integer')->setLabel(t('ID'))
      ->setDescription(t('The ID of the Processo entity.'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Processo entity.'))
      ->setReadOnly(TRUE);

    $fields['title'] = BaseFieldDefinition::create('string')->setLabel(t('Titolo'))
      ->setDescription(t('Il titolo del Processo.'))
   	  ->setRequired(TRUE)
      ->setSettings([
      'max_length' => 255,
      'text_processing' => 0
    ])
      ->setDefaultValue(NULL)
      ->setDisplayOptions('view', [
      'label' => 'above',
      'type' => 'string',
      'weight' => - 6
    ])
      ->setDisplayOptions('form', [
      'type' => 'string_textfield',
      'weight' => - 6
    ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);


    $fields['id_tipo_intervento'] = BaseFieldDefinition::create('entity_reference')
		->setLabel(t('Tipo Intervento'))
		->setDescription(t('Tipo di Intervento'))
		->setSetting('target_type', 'intervento')
		->setRequired(TRUE)
		->setDisplayOptions('view', [
		'label' => 'above',
		'type' => 'string',
		'weight' => - 5
    ])
    ->setDisplayOptions('form', [
		'weight' => - 5
    ])
    ->setDisplayConfigurable('form', TRUE)
    ->setDisplayConfigurable('view', TRUE);



      $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

      $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }
}