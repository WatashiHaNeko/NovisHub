<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table {
  public function validationDefault(Validator $validator): Validator {
    $validator->notEmptyString('auth_id', __('{0}を入力してください。', __('ログインID')), 'create');

    $validator->notEmptyString('auth_password', __('{0}を入力してください。', __('パスワード')), 'create');

    return $validator;
  }
}

