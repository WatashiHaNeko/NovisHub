<div class="my-5 row justify-content-center">
  <div class="col-12 col-md-8 col-lg-6">
    <div class="card mb-2">
      <div class="card-body">
        <?= $this->Form->create($user, ['type' => 'file', 'novalidate' => true]) ?>
          <div class="mb-3">
            <label class="form-label">
              <?= __('アバター画像') ?>
            </label>

            <label class="position-relative d-flex justify-content-center align-items-center">
              <?= $this->Form->file('avatar_file', [
                'accept' => 'image/*',
                'id' => 'avatar-file-field',
                'class' => 'd-none',
              ]) ?>

              <img src="<?= $user->getAvatarUrl() ?>" id="avatar-preview" style="<?= $this->Html->style([
                'width' => '200px',
                'height' => '200px',
                'background-color' => '#999999',
                'border-radius' => '50%',
                'box-shadow' => '0 0 12px 4px #99999999',
                'object-fit' => 'cover',
              ]) ?>">

              <svg viewBox="0 0 16 16" class="position-absolute text-white" fill="currentColor" style="<?= $this->Html->style([
                'top' => '0',
                'right' => '0',
                'bottom' => '0',
                'left' => '0',
                'margin' => 'auto',
                'width' => '48px',
                'height' => '48px',
                'opacity' => '0.5',
              ]) ?>">
                <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                <path d="M10.648 7.646a.5.5 0 0 1 .577-.093L15.002 9.5V13h-14v-1l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71z"/>
                <path fill-rule="evenodd" d="M4.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
              </svg>
            </label>
          </div>

          <button class="btn btn-primary">
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
  const avatarFileField = document.querySelector("#avatar-file-field");
  const avatarPreview = document.querySelector("#avatar-preview");

  avatarFileField.addEventListener("change", (event) => {
    const fileReader = new FileReader();

    fileReader.addEventListener("load", (event) => {
      avatarPreview.src = fileReader.result;
    });

    fileReader.readAsDataURL(avatarFileField.files[0]);
  });
});
</script>
<?php $this->end(); ?>

