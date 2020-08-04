<div class="my-5 row justify-content-center">
  <div class="col-12 col-md-8 col-lg-6">
    <div class="card mb-2">
      <div class="card-body">
        <?= $this->Form->create($user, ['novalidate' => true]) ?>
          <div class="mb-3">
            <label class="form-label">
              <?= __('新しい{0}', __('パスワード')) ?>
            </label>

            <?= $this->Form->password('auth_password', [
              'id' => 'auth-password-field',
              'class' => implode(' ', [
                'form-control',
                $this->Form->isFieldError('auth_password') ? 'is-invalid' : '',
              ]),
              'value' => '',
            ]) ?>

            <div class="invalid-feedback">
              <?= $this->Form->error('auth_password') ?>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">
              <?= __('新しい{0}（確認）', __('パスワード')) ?>
            </label>

            <input type="password" id="auth-password-confirm-field" class="form-control">

            <div id="auth-password-confirm-invalid-feedback-text" class="invalid-feedback"></div>
          </div>

          <button id="submit-button" class="btn btn-primary" disabled>
            <svg width="1em" height="1em" viewBox="3 3 12 12" class="" fill="currentColor">
              <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
            </svg>

            <?= __('ユーザー情報を保存する') ?>
          </button>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</div>

<?php $this->append('script'); ?>
<script>
window.addEventListener("DOMContentLoaded", (event) => {
  const authPasswordField = document.querySelector("#auth-password-field");
  const authPasswordConfirmField = document.querySelector("#auth-password-confirm-field");
  const submitButton = document.querySelector("#submit-button");

  authPasswordConfirmField.addEventListener("input", (event) => {
    const isAuthPasswordConfirmed = authPasswordField.value === authPasswordConfirmField.value;

    if (isAuthPasswordConfirmed) {
      authPasswordConfirmField.classList.remove("is-invalid");

      submitButton.disabled = false;
    } else {
      authPasswordConfirmField.classList.add("is-invalid");

      submitButton.disabled = true;
    }
  });
});
</script>
<?php $this->end(); ?>

