<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table {
  public function initialize(array $config): void {
    parent::initialize($config);

    $this->hasMany('UserTags');
  }

  public function validationDefault(Validator $validator): Validator {
    $validator
        ->requirePresence('auth_id', 'create')
        ->notEmptyString('auth_id', __('{0}を入力してください。', __('ログインID')))
        ->add('auth_id', 'custom', [
          'rule' => function ($value, $context) {
            return !!preg_match('/^([a-zA-Z0-9_]+)$/', $value);
          },
          'message' => __('{0}は数字、アルファベット、_ (アンダーバー)で入力してください', __('ログインID')),
        ]);

    $validator
        ->requirePresence('auth_password', 'create')
        ->notEmptyString('auth_password', __('{0}を入力してください。', __('パスワード')));

    $validator->notEmptyString('name', __('{0}を入力してください。', __('名前')));

    $validator
        ->add('profile_summary', 'custom', [
          'rule' => function ($value, $context) {
            return substr_count($value, "\n") < 3;
          },
          'message' => __('{0}は３行以下で入力してください。', __('検索用プロフィール')),
        ])
        ->add('profile_summary', 'custom', [
          'rule' => function ($value, $context) {
            $value = preg_replace('/\r\n/', "\n", $value);

            return mb_strlen($value) <= 50;
          },
          'message' => __('{0}は５０文字以下で入力してください。', __('検索用プロフィール')),
        ]);

    return $validator;
  }
}

