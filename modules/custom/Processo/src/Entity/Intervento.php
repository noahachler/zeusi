<?php
namespace Drupal\processo\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\processo\InterventoInterface;
use Drupal\user\UserInterface;
use Drupal\Core\Entity\EntityChangedTrait;

/**
 *
 * @ingroup processo
 *
 * @ContentEntityType(
 * id = "intervento",
 * label = @Translation("Intervento entity"),
 * handlers = {
 * "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 * "list_builder" = "Drupal\processo\Entity\Controller\InterventoListBuilder",
 * "form" = {
 * "add" = "Drupal\processo\Form\InterventoForm",
 * "edit" = "Drupal\processo\Form\InterventoForm",
 * "delete" = "Drupal\processo\Form\InterventoDeleteForm",
 * },
 * "access" = "Drupal\processo\InterventoAccessControlHandler",
 * },
 * list_cache_contexts = { "user" },
 * base_table = "zeusi.tipo_intervento",
 * admin_permission = "administer intervento entity",
 * entity_keys = {
 * "id" = "id",
 * "uuid" = "uuid",
 * "label" = "nome"
 * },
 * links = {
 * "canonical" = "/intervento/{intervento}",
 * "edit-form" = "/intervento/{intervento}/edit",
 * "delete-form" = "/intervento/{intervento}/delete",
 * "collection" = "/intervento/list"
 * },
 * field_ui_base_route = "processo.intervento_settings",
 * )
 *
 */
class Intervento extends ContentEntityBase implements InterventoInterface
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
      ->setDescription(t('The ID of the Intervento entity.'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Intervento entity.'))
      ->setReadOnly(TRUE);

    $fields['nome'] = BaseFieldDefinition::create('string')->setLabel(t('Nome'))
      ->setDescription(t('Il Nome del Tipo intervento.'))
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



    $fields['descrizione'] = BaseFieldDefinition::create('string_long')->setLabel(t('Descrizione'))
      ->setDescription(t('La descrizione del Tipo Intervento.'))
      ->setSettings([
      'rows' => 10,
      'max_length' => 500,
      'text_processing' => 0
    ])
      ->setDefaultValue(NULL)
      ->setDisplayOptions('view', [
      'label' => 'above',
      'type' => 'string',
      'weight' => - 5
    ])
      ->setDisplayOptions('form', [
      'type' => 'string_textfield',
      'weight' => - 5
    ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['pattern'] = BaseFieldDefinition::create('string')->setLabel(t('Pattern'))
      ->setDescription(t('Il Pattern del Tipo Intervento.'))
      ->setRequired(TRUE)
      ->setSettings([
      'max_length' => 100,
      'text_processing' => 0
    ])
      ->setDefaultValue(NULL)
      ->setDisplayOptions('view', [
      'label' => 'above',
      'type' => 'string',
      'weight' => - 4
    ])
      ->setDisplayOptions('form', [
      'type' => 'string_textfield',
      'weight' => - 4
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