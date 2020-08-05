<?php
declare(strict_types=1);

namespace App\Controller;

use App\Exception\Exception as AppException;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Log\Log;

class UsersController extends AppController {
  public function index() {
    $usersQuery = $this->Users->find()
        ->contain(['UserTags.Tags'])
        ->order(['Users.created' => 'desc']);

    $searchTagLabel = $this->request->getQuery('tag_label');

    if (!empty($searchTagLabel)) {
      $usersQuery
          ->matching('UserTags.Tags', function ($q) use ($searchTagLabel) {
            return $q
                ->where([
                  ['Tags.label' => $searchTagLabel],
                ]);
          });
    }

    $searchText = $this->request->getQuery('text');

    if (!empty($searchText)) {
      $usersQuery
          ->where([
            [
              'OR' => [
                ['Users.name LIKE' => sprintf('%%%s%%', $searchText)],
                ['Users.profile_summary LIKE' => sprintf('%%%s%%', $searchText)],
              ],
            ],
          ]);
    }

    $users = $this->paginate($usersQuery, [
      'limit' => 20,
    ]);

    $this->set(compact([
      'users',
    ]));
  }

  public function view(string $id) {
    $user = $this->Users->find()
        ->where([
          ['Users.id' => $id],
        ])
        ->first();

    $this->set(compact([
      'user',
    ]));
  }

  public function signup() {
    $user = null;

    if ($this->request->is(['post'])) {
      try {
        $user = $this->Users->newEntity([
          'auth_id' => $this->request->getData('auth_id', ''),
          'auth_password' => $this->request->getData('auth_password', ''),
          'name' => $this->request->getData('auth_id', ''),
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

        $this->Auth->setUser([
          'id' => $user['id'],
        ]);

        $this->Flash->success(__('アカウント登録が完了しました。'));

        return $this->redirect([
          'prefix' => 'Settings',
          'controller' => 'Home',
          'action' => 'index',
        ]);
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

  public function signin() {
    if ($this->request->is(['post'])) {
      try {
        $user = $this->Users->find()
            ->where([
              ['Users.auth_id' => $this->request->getData('auth_id', '')],
            ])
            ->first();

        if (empty($user)) {
          throw new AppException(__('入力内容を確認してください。'));
        }

        $passwordHasher = new DefaultPasswordHasher();

        $isPasswordValid = $passwordHasher->check($this->request->getData('auth_password', ''), $user['auth_password']);

        if (!$isPasswordValid) {
          throw new AppException(__('入力内容を確認してください。'));
        }

        $this->Auth->setUser([
          'id' => $user['id'],
        ]);

        $this->Flash->success(__('ログインに成功しました。'));

        return $this->redirect([
          'prefix' => 'Settings',
          'controller' => 'Home',
          'action' => 'index',
        ]);
      } catch (AppException $exception) {
        $this->Flash->error(implode('', [
          __('ログインに失敗しました。'),
          $exception->getMessage(),
        ]));
      }
    }
  }
}

