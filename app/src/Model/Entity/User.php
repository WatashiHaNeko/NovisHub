<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Core\Configure;
use Cake\ORM\Entity;
use Cake\Routing\Asset;

class User extends Entity {
  protected $_accessible = [
    '*' => true,
    'id' => false,
  ];

  protected $_hidden = [
    'auth_password',
  ];

  public function getAvatarDirname(): string {
    return WWW_ROOT . implode(DS, [
      'upload', 'users', $this['id'],
      'avatar',
    ]);
  }

  public function getAvatarFilename(bool $originalSize = false): string {
    $filename = $this['avatar_filename'];

    if (!$originalSize) {
      $filename .= '.400';
    }

    $filename .= '.jpg';

    return $filename;
  }

  public function getAvatarUrl(): string {
    if (empty($this['avatar_filename'])) {
      return Asset::imageUrl('avatar-default.svg', [
        'fullBase' => true,
      ]);
    }

    return implode('/', [
      Configure::read('App.fullBaseUrl'),
      'upload', 'users', $this['id'], 'avatar',
      $this->getAvatarFilename(),
    ]);
  }

  protected function _setAuthPassword($authPassword) {
    if (!empty($authPassword)) {
      $passwordHasher = new DefaultPasswordHasher;

      return $passwordHasher->hash($authPassword);
    }
  }
}

