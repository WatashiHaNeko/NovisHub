<?php
declare(strict_types=1);

namespace App\Controller;

use App\Exception\Exception as AppException;
use Cake\Log\Log;

class UsersController extends AppController {
  public function signup() {
    $user = null;

    if ($this->request->is(['post'])) {
      try {
        $user = $this->Users->newEntity([
          'auth_id' => $this->request->getData('auth_id', ''),
          'auth_password' => $this->request->getData('auth_id', ''),
        ]);

        if ($user->hasErrors()) {
          throw new AppException(__('入力内容を確認してください。'));
        }

        $isAuthIdAvailable = $this->Users->find()
            ->where([
              ['Users.auth_id' => $user['auth_id']],
            ])
            ->first() === null;

        if ($user->hasErrors()) {
          $user->setError('auth_id', __('この{0}は既に使用されています。', __('ログインID')));

          throw new AppException();
        }

        $userSaved = $this->Users->save($user);

        if (!$userSaved) {
          throw new AppException(__('時間を置いて再度お試しください。'));
        }

        $this->Flash->success(__('アカウント登録が完了しました。'));
      } catch (AppException $exception) {
        $this->Flash->error(implode('', [
          __('アカウント登録に失敗しました。'),
          $exception->getMessage(),
        ]));
      }
    }

    $this->set(compact([
      'user',
    ]));
  }
}

