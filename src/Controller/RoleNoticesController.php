<?php

namespace Drupal\role_notices\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class RoleNoticesController.
 *
 * @package Drupal\role_notices\Controller
 */
class RoleNoticesController extends ControllerBase {
  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function page() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('hello world'),
    ];
  }

}
