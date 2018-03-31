<?php
/**
 * @file
 * Contains \Drupal\zeusi_webgl\Test.
 */
namespace Drupal\zeusi_webgl\Controller;

use Drupal\Core\Controller\ControllerBase;

class Test extends ControllerBase {

  public function content() {
    return [
      '#theme' => 'test',
      '#test_class' => 'DAJE !!!'
    ];
  }
}