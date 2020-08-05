<?php
declare(strict_types=1);

namespace App\Controller\Settings;

use App\Exception\Exception as AppException;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Time;
use Imagick;
use Laminas\Diactoros\Exception\InvalidArgumentException;
use Laminas\Diactoros\Exception\UploadedFileAlreadyMovedException;
use Laminas\Diactoros\Exception\UploadedFileErrorException;

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

  public function profile() {
    $user = $this->authUser;

    if ($this->request->is(['put'])) {
      try {
        $this->Users->patchEntity($user, [
          'profile' => $this->request->getData('profile', ''),
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

  public function profileSummary() {
    $user = $this->authUser;

    if ($this->request->is(['put'])) {
      try {
        $this->Users->patchEntity($user, [
          'profile_summary' => $this->request->getData('profile_summary', ''),
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

  public function avatar() {
    $user = $this->authUser;

    $session = $this->request->getSession();

    if ($this->request->is(['put'])) {
      try {
        ConnectionManager::get('default')->transactional(function ($connection) use (&$user, $session) {
          $avatarFile = $this->request->getData('avatar_file');

          if ($avatarFile->getError() !== UPLOAD_ERR_OK) {
            throw new AppException(__('{0}のアップロードに失敗しました。', __('アバター画像')));
          }

          $dirname = $user->getAvatarDirname();

          if (!file_exists($dirname)) {
            $umask = umask(0);
            $mkdirResult = mkdir($dirname, 0777, true);
            umask($umask);

            if (!$mkdirResult) {
              throw new AppException(__('時間を置いて再度お試しください。'));
            }
          }

          $tmpFilepath = implode(DS, [
            $dirname,
            vsprintf('tmp-%s', [
              Time::now()->i18nFormat('yyyyMMddHHmmss'),
            ]),
          ]);

          try {
            $avatarFile->moveTo($tmpFilepath);
          } catch (InvalidArgumentException $exception) {
            throw new AppException($exception->getMessage());
          } catch (UploadedFileAlreadyMovedException $exception) {
            throw new AppException($exception->getMessage());
          } catch (UploadedFileErrorException $exception) {
            throw new AppException($exception->getMessage());
          }

          $session->write('User.avatar.tmpFilepath', $tmpFilepath);

          $user['avatar_filename'] = hash_file('sha256', $tmpFilepath);

          $imagick = new Imagick();

          $imagick->readImage($tmpFilepath);
          $imagick->setImageFormat('jpg');
          $imagick->resizeImage(1200, 1200, Imagick::FILTER_LANCZOS, 1, true);

          $filepath = implode(DS, [
            $dirname,
            $user->getAvatarFilename(true),
          ]);

          $imageWritten = $imagick->writeImage($filepath);

          if (!$imageWritten) {
            throw new AppException(__('{0}の保存に失敗しました。', __('アバター画像')));
          }

          $imagick->readImage($tmpFilepath);
          $imagick->setImageFormat('jpg');
          $imagick->resizeImage(400, 400, Imagick::FILTER_LANCZOS, 1, true);

          $filepath = implode(DS, [
            $dirname,
            $user->getAvatarFilename(),
          ]);

          $imageWritten = $imagick->writeImage($filepath);

          if (!$imageWritten) {
            throw new AppException(__('{0}の保存に失敗しました。', __('アバター画像')));
          }

          $userSaved = $this->Users->save($user);

          if (!$userSaved) {
            throw new AppException(__('時間を置いて再度お試しください。'));
          }

          unlink($tmpFilepath);

          $session->delete('User.avatar.tmpFilepath');
        });

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

  public function authPassword() {
    $user = $this->authUser;

    if ($this->request->is(['put'])) {
      try {
        $this->Users->patchEntity($user, [
          'auth_password' => $this->request->getData('auth_password', ''),
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
}

