<?php
declare(strict_types=1);

namespace App\Controller\Settings;

class UsersController extends SettingsController {
  public function signout() {
    if ($this->request->is(['post'])) {
      $this->Auth->logout();

      $this->Flash->success(__('アカウントからログアウトしました。'));
    }

    return $this->redirect($this->request->referer());
  }
}

