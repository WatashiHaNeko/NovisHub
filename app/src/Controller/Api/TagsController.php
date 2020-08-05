<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Exception\Exception as AppException;
use Cake\Log\Log;

class TagsController extends ApiController {
  public function initialize(): void {
    parent::initialize();
  }

  public function index() {
    try {
      $tags = $this->Tags->find()
          ->select([
            'label',
          ])
          ->order(['Tags.used_count' => 'desc'])
          ->toList();

      $this->responseData['data'] = [
        'tags' => $tags,
      ];
    } catch (AppException $exception) {
      $this->responseData['success'] = false;
      $this->responseData['error_message'] = $exception->getMessage();
    }
  }
}

