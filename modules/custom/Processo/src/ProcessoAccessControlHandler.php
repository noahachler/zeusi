<?php

namespace Drupal\processo;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

class ProcessoAccessControlHandler extends EntityAccessControlHandler {

  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'zeusi');

      case 'edit':
        return AccessResult::allowedIfHasPermission($account, 'zeusi');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'zeusi');
    }
    return AccessResult::allowed();
  }

  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'zeusi');
  }
}