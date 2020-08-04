<?php
declare(strict_types=1);

namespace App\Controller\Settings;

use App\Exception\Exception as AppException;

class UsersController extends SettingsController {
  public function signout() {
    if ($this->request->is(['post'])) {
      $this->Auth->logout();

      $this->Flash->success(__('アカウントからログアウトしました。'));
    }

    return $this->redirect($this->request->referer());
  }

  public function name() {
    $user = $this->authUser;

    if ($this->request->is(['put'])) {
      try {
        $this->Users->patchEntity($user, [
          'name' => $this->request->getData('name', ''),
        ]);

        if ($user->hasErrors()) {
          throw new AppException(__('入力内容を確認してください。'));
        }

        $userSaved = $this->Users->save($user);

        if (!$userSaved) {
          throw new AppException(__('時間を置いて再度お試しください。'));
        }

        $this->Flash->success(__('{0}を保存しました。', __('ユーザー情報')));

        return $this->redirect([
          'controller' => 'Home',
          'action' => 'index',
        ]);
      } catch (AppException $exception) {
        $this->Flash->error(implode('', [
          __('{0}の保存に失敗しました。', __('ユーザー情報')),
          $exception->getMessage(),
        ]));
      }
    }

    $this->set(compact([
      'user',
    ]));
  }

  public function authId() {
    $user = $this->authUser;

    if ($this->request->is(['put'])) {
      try {
        $this->Users->patchEntity($user, [
          'auth_id' => $this->request->getData('auth_id', ''),
        ]);

        if ($user->hasErrors()) {
          throw new AppException(__('入力内容を確認してください。'));
        }

        $isAuthIdAvailable = $this->Users->find()
            ->where([
              ['Users.auth_id' => $user['auth_id']],
            ])
            ->first() === null;

        if (!$isAuthIdAvailable) {
          $user->setError('auth_id', __('この{0}は既に使用されています。', __('ログインID')));

          throw new AppException(__('入力内容を確認してください。'));
        }

        $userSaved = $this->Users->save($user);

        if (!$userSaved) {
          throw new AppException(__('時間を置いて再度お試しください。'));
        }

        $this->Flash->success(__('{0}を保存しました。', __('ユーザー情報')));

        return $this->redirect([
          'controller' => 'Home',
          'action' => 'index',
        ]);
      } catch (AppException $exception) {
        $this->Flash->error(implode('', [
          __('{0}の保存に失敗しました。', __('ユーザー情報')),
          $exception->getMessage(),
        ]));
      }
    }

    $this->set(compact([
      'user',
    ]));
  }
}

