<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Exception\Exception as AppException;
use Cake\Log\Log;
use cebe\markdown\GithubMarkdown;

class UsersController extends ApiController {
  public function previewProfile() {
    try {
      if (!$this->request->is(['post'])) {
        throw new AppException(__('不正なリクエストです。'));
      }

      $parser = new GithubMarkdown();

      $html = $parser->parse($this->request->getData('text', ''));

      $this->responseData['data'] = [
        'html' => $html,
      ];
    } catch (AppException $exception) {
      $this->responseData['success'] = false;
      $this->responseData['error_message'] = $exception->getMessage();
    }
  }
}

