<?php

namespace Drupal\role_notices\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the role_notices module.
 */
class RoleNoticesControllerTest extends WebTestBase {
  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "role_notices RoleNoticesController's controller functionality",
      'description' => 'Test Unit for module role_notices and controller RoleNoticesController.',
      'group' => 'Other',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests role_notices functionality.
   */
  public function testRoleNoticesController() {
    // Check that the basic functions of module role_notices.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via App Console.');
  }

}
