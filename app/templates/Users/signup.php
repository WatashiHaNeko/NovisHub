<div class="my-5 row justify-content-center">
  <div class="col-12 col-md-8 col-lg-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-3">
          <?= __('新規登録') ?>
        </h5>

        <?= $this->Form->create($user, ['novalidate' => true]) ?>
          <div class="mb-3">
            <label class="form-label">
              <?= __('ログインID') ?>
            </label>

            <?= $this->Form->text('auth_id', [
              'class' => implode(' ', [
                'form-control',
                $this->Form->isFieldError('auth_id') ? 'is-invalid' : '',
              ]),
            ]) ?>

            <div class="invalid-feedback">
              <?= $this->Form->error('auth_id') ?>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">
              <?= __('パスワード') ?>
            </label>

            <?= $this->Form->password('auth_password', [
              'class' => implode(' ', [
                'form-control',
                $this->Form->isFieldError('auth_password') ? 'is-invalid' : '',
              ]),
            ]) ?>

            <div class="invalid-feedback">
              <?= $this->Form->error('auth_password') ?>
            </div>
          </div>

          <button class="btn btn-primary">
            <svg width="1em" height="1em" viewBox="3 3 12 12" class="" fill="currentColor">
              <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
            </svg>

            <?= __('新しいアカウントを登録する') ?>
          </button>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</div>

