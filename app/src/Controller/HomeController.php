<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Log\Log;

class HomeController extends AppController {
  public function initialize(): void {
    parent::initialize();

    $this->loadModel('Users');
  }

  public function index() {
    $users = $this->Users->find()
        ->contain(['UserTags.Tags'])
        ->order(['Users.created' => 'desc'])
        ->limit(10)
        ->toList();

    $this->set(compact([
      'users',
    ]));
  }
}

