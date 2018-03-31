<?php

namespace Drupal\processo;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;


interface InterventoInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
