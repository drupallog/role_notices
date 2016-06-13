<?php
namespace Drupal\role_notices;
use Drupal\Core\

class NoticesManger {
  protected $state;
  protected $user;

}
public function __construct(AccountInterface $user, StateInterface $state) {
  $this->user = $user;
  $this->state = $state;
}

public function getUserNotices() {
  $all_notices = $this->state->get('role_notices_notices');
  $user_notices = array_intersect_key($all_notices,array_flip($this->user->getRoles()));
  \Drupal::moduleHandler()->alert('role_notices',$user_notices);
  return $user_notices;
}

public function getAllNotices() {
  return $this->state->get('role_notices_notices');
}

public function setAllNotices(array $notices) {
  $updated_keys = $this->getUpdateNotices($notices);
  $this->state->set('role_notices_notices',$notices);

  if ($updated_keys) {
    # code...
    Cache::invalidateTags($this->getRenderTags($updated_keys));
  }
}

?>
