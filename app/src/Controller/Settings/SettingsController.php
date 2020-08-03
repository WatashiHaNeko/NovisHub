<?php
declare(strict_types=1);

namespace App\Controller\Settings;

use App\Controller\AppController;
use Cake\Event\EventInterface;

class SettingsController extends AppController {
  public function beforeFilter(EventInterface $event) {
    parent::beforeFilter($event);

    $this->Auth->deny();
  }
}

