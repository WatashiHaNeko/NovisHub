<div class="my-3">
  <h2 class="h4 mb-2">
    <?= __('公開情報') ?>
  </h2>

  <div class="list-group mb-3">
    <?= $this->element('Settings/Home/index/list_item', [
      'url' => $this->Url->build([
        'controller' => 'Users',
        'action' => 'name',
      ]),
      'label' => __('名前'),
      'value' => h($authUser['name']),
    ]) ?>

    <?= $this->element('Settings/Home/index/list_item', [
      'url' => $this->Url->build([
        'controller' => 'Users',
        'action' => 'profile',
      ]),
      'label' => __('プロフィール'),
    ]) ?>

    <?= $this->element('Settings/Home/index/list_item', [
      'url' => $this->Url->build([
        'controller' => 'Users',
        'action' => 'profileSummary',
      ]),
      'label' => __('検索用プロフィール'),
    ]) ?>

    <?= $this->element('Settings/Home/index/list_item', [
      'url' => $this->Url->build([
        'controller' => 'Users',
        'action' => 'tags',
      ]),
      'label' => __('検索用タグ'),
    ]) ?>

    <?= $this->element('Settings/Home/index/list_item', [
      'url' => $this->Url->build([
        'controller' => 'Users',
        'action' => 'avatar',
      ]),
      'label' => __('アバター画像'),
    ]) ?>
  </div>

  <h2 class="h4 mb-2">
    <?= __('アカウント情報') ?>
  </h2>

  <div class="list-group mb-3">
    <?= $this->element('Settings/Home/index/list_item', [
      'url' => $this->Url->build([
        'controller' => 'Users',
        'action' => 'auth_id',
      ]),
      'label' => __('ログインID'),
      'value' => h($authUser['auth_id']),
    ]) ?>

    <?= $this->element('Settings/Home/index/list_item', [
      'url' => $this->Url->build([
        'controller' => 'Users',
        'action' => 'auth_password',
      ]),
      'label' => __('パスワード'),
      'value' => __('設定したパスワード'),
    ]) ?>
  </div>

  <h2 class="h4 mb-2">
    <?= __('ログアウト') ?>
  </h2>

  <div class="list-group mb-3">
    <?= $this->Form->postLink(__('ログアウトする'), [
      'controller' => 'Users',
      'action' => 'signout',
    ], [
      'block' => true,
      'confirm' => __('アカウントからログアウトしますか？'),
      'class' => 'list-group-item list-group-item-action text-center',
    ]) ?>
  </div>

  <h2 class="h4 mb-2">
    <?= __('アカウント削除') ?>
  </h2>

  <div class="list-group mb-3">
    <?= $this->Form->postLink(__('アカウントを削除する'), [
      'controller' => 'Users',
      'action' => 'delete',
    ], [
      'block' => true,
      'confirm' => __('アカウントを削除しますか？この動作は取り消すことができません。'),
      'class' => 'list-group-item list-group-item-action list-group-item-danger text-center',
    ]) ?>
  </div>
</div>

