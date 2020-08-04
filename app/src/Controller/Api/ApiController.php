<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Event\EventInterface;

class ApiController extends AppController {
  public function initialize(): void {
    parent::initialize();
  }

  public function beforeFilter(EventInterface $event): void {
    parent::beforeFilter($event);

    $this->responseData = [
      'success' => true,
      'error_message' => '',
      'data' => [],
    ];
  }

  public function beforeRender(EventInterface $event): void {
    parent::beforeRender($event);

    $this->set($this->responseData);

    $this->viewBuilder()
        ->setOption('serialize', array_keys($this->responseData));
  }
}

