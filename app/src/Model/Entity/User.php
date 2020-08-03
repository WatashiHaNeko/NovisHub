<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class User extends Entity {
  protected $_accessible = [
    '*' => true,
    'id' => false,
  ];

  protected $_hidden = [
    'auth_password',
  ];

  protected function _setAuthPassword($authPassword) {
    if (!empty($authPassword)) {
      $passwordHasher = new DefaultPasswordHasher;

      return $passwordHasher->hash($authPassword);
    }
  }
}

