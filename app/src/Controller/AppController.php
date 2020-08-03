<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Cake\Log\Log;

class AppController extends Controller {
  public function initialize(): void {
    parent::initialize();

    $this->loadComponent('Auth');
    $this->loadComponent('Flash');
    $this->loadComponent('RequestHandler');
  }

  public function beforeFilter(EventInterface $event) {
    parent::beforeFilter($event);

    $this->Auth->allow();
  }
}

