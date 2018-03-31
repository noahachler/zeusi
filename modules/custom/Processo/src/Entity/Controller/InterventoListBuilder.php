<?php

namespace Drupal\processo\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Routing\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @ingroup intervento
 */
class InterventoListBuilder extends EntityListBuilder {

  protected $urlGenerator;

  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type) {
    return new static(
      $entity_type,
      $container->get('entity.manager')->getStorage($entity_type->id()),
      $container->get('url_generator')
    );
  }

  public function __construct(EntityTypeInterface $entity_type, EntityStorageInterface $storage, UrlGeneratorInterface $url_generator) {
    parent::__construct($entity_type, $storage);
    $this->urlGenerator = $url_generator;
  }

  public function render() {
    $build['table'] = parent::render();
    return $build;
  }

  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['nome'] = $this->t('Nome');
    $header['descrizione'] = $this->t('Descrizione');
    return $header + parent::buildHeader();
  }

  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\processo\Entity\Intervento */
    $row['id'] = $entity->id();
    $row['nome'] = $entity->nome->value;
    $row['descrizione'] = $entity->descrizione->value;
    return $row + parent::buildRow($entity);
  }

}
