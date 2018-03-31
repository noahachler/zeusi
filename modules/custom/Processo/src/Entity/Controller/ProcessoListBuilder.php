<?php

namespace Drupal\processo\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Routing\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @ingroup zeusi_poc
 */
class ProcessoListBuilder extends EntityListBuilder {

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
    $header['title'] = $this->t('Titolo');
    return $header + parent::buildHeader();
  }

  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\processo\Entity\Processo */
    $row['id'] = $entity->id();
    $row['title'] = $entity->link();
    return $row + parent::buildRow($entity);
  }

}
