<?php
$this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/4.0.0/github-markdown.min.css', [
  'block' => true,
]);

$this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.1.2/styles/github.min.css', [
  'block' => true,
]);

$this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.1.2/highlight.min.js', [
  'block' => true,
]);
?>

<div class="my-5 row justify-content-center">
  <div class="col-12 col-md-8 col-lg-6">
    <div class="card mb-2">
      <div class="card-body">
        <?= $this->Form->create($user, ['novalidate' => true]) ?>
          <div class="mb-3">
            <div class="row">
              <div class="col">
                <label class="form-label">
                  <?= __('プロフィール') ?>
                </label>
              </div>

              <div class="col-auto">
                <button type="button" id="preview-button" class="btn btn-sm btn-outline-info">
                  <span id="preview-button-spinner" class="spinner-border spinner-border-sm d-none"></span>

                  <?= __('プレビュー') ?>
                </button>
              </div>
            </div>

            <?= $this->Form->textarea('profile', [
              'id' => 'profile-field',
              'class' => implode(' ', [
                'form-control',
                $this->Form->isFieldError('profile') ? 'is-invalid' : '',
              ]),
            ]) ?>

            <div class="invalid-feedback">
              <?= $this->Form->error('profile') ?>
            </div>
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

<?php $this->append('modal'); ?>
<div id="preview-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <?= __('プレビュー') ?>
        </h5>

        <button type="button" class="close" data-dismiss="modal">
          <span>×</span>
        </button>
      </div>

      <div class="modal-body markdown-body"></div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php $this->end(); ?>

<?php $this->append('script'); ?>
<script>
window.addEventListener("DOMContentLoaded", (event) => {
  const previewButton = document.querySelector("#preview-button");
  const previewButtonSpinner = document.querySelector("#preview-button-spinner");
  const profileField = document.querySelector("#profile-field");
  const previewModal = document.querySelector("#preview-modal");

  previewButton.addEventListener("click", async (event) => {
    previewButton.disabled = true;
    previewButtonSpinner.classList.remove("d-none");

    const formData = new FormData();

    formData.append("text", profileField.value);

    const response = await fetch("<?= $this->Url->build([
      'prefix' => 'Api',
      'controller' => 'Users',
      'action' => 'previewProfile',
      '_ext' => 'json',
    ]) ?>", {
      method: "post",
      body: formData,
    }).catch((error) => {
      return {
        ok: false,
      };
    });

    if (!response.ok) {
      return alert("<?= __('{0}の取得に失敗しました。', __('プレビュー')) ?>");
    }

    const responseData = await response.json().catch((error) => {
      alert("<?= __('{0}の表示に失敗しました。', __('プレビュー')) ?>");

      return null;
    });

    const modalBody = previewModal.querySelector(".modal-body");

    modalBody.innerHTML = responseData.data.html;

    modalBody.querySelectorAll("pre code").forEach((block) => {
      hljs.highlightBlock(block);
    });

    const bsModal = new bootstrap.Modal(previewModal);

    bsModal.show();
  });

  previewModal.addEventListener("show.bs.modal", (event) => {
    previewButton.disabled = false;
    previewButtonSpinner.classList.add("d-none");
  });
});
</script>
<?php $this->end(); ?>

