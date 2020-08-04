<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table {
  public function validationDefault(Validator $validator): Validator {
    $validator
        ->notEmptyString('auth_id', __('{0}を入力してください。', __('ログインID')), 'create')
        ->add('auth_id', 'custom', [
          'rule' => function ($value, $context) {
            return !!preg_match('/^([a-zA-Z0-9_]+)$/', $value);
          },
          'message' => __('{0}は数字、アルファベット、_ (アンダーバー)で入力してください', __('ログインID')),
        ]);

    $validator->notEmptyString('auth_password', __('{0}を入力してください。', __('パスワード')), 'create');

    $validator->notEmptyString('name', __('{0}を入力してください。', __('名前')), 'update');

    return $validator;
  }
}

