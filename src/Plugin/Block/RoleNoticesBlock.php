<?php

namespace Drupal\role_notices\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\role_notices\NoticesManger;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'RoleNoticesBlock' block.
 *
 * @Block(
 *  id = "role_notices_block",
 *  admin_label = @Translation("Role notices block"),
 * )
 */
class RoleNoticesBlock extends BlockBase implements ContainerFactoryPluginInterface {
    protected $noticesManager;

    public function __construct(array $configuration, $plugin_id, $plugin_definition, NoticesManger $notices_manager){
        parent::__construct($configuration, $plugin_id, $plugin_definition);
        $this->noticesManager = $notices_manager;

    }

    public static function create(ContainerInterface $container,array $configuration, $plugin_id, $plugin_definition){
        return new static(
            $configuration,
            $plugin_id,
            $plugin_definition,
            $container->get('role_notices.notice_manager')
        );
    }

    protected function blockAccess(AccountInterface $account){
        return AccessResult::allowedIf($account->isAuthenticated());
    }

  /**
   * {@inheritdoc}
   */
  public function build() {

    return array(
        '#theme' => 'item_list',
        '#items' => $this->noticesManager->getUserNotices(),
    );
  }

}
