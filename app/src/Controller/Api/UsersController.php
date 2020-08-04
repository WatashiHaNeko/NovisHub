<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Exception\Exception as AppException;
use Cake\Log\Log;

class UsersController extends ApiController {
  public function initialize(): void {
    parent::initialize();

    $this->loadComponent('Markdown');
  }

  public function previewProfile() {
    try {
      if (!$this->request->is(['post'])) {
        throw new AppException(__('不正なリクエストです。'));
      }

      $this->responseData['data'] = [
        'html' => $this->Markdown->parse($this->request->getData('text')),
      ];
    } catch (AppException $exception) {
      $this->responseData['success'] = false;
      $this->responseData['error_message'] = $exception->getMessage();
    }
  }
}

