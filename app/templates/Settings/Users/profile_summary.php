<div class="my-5 row justify-content-center">
  <div class="col-12 col-md-8 col-lg-6">
    <div class="card mb-2">
      <div class="card-body">
        <?= $this->Form->create($user, ['novalidate' => true]) ?>
          <div class="mb-3">
            <div class="row">
              <div class="col">
                <label class="form-label">
                  <?= __('検索用プロフィール') ?>
                </label>
              </div>

              <div class="col-auto">
                <span id="input-length-text"></span>
              </div>
            </div>

            <?= $this->Form->textarea('profile_summary', [
              'id' => 'profile-summary-field',
              'class' => implode(' ', [
                'form-control',
                $this->Form->isFieldError('profile_summary') ? 'is-invalid' : '',
              ]),
            ]) ?>

            <div class="invalid-feedback">
              <?= $this->Form->error('profile_summary') ?>
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

<?php $this->append('script'); ?>
<script>
window.addEventListener("DOMContentLoaded", (event) => {
  const inputLengthText = document.querySelector("#input-length-text");
  const profileSummaryField = document.querySelector("#profile-summary-field");

  window.addEventListener("ProfileSummaryFieldInput", (event) => {
    const inputLength = profileSummaryField.value.length;

    if (inputLength > 50) {
      inputLengthText.classList.add("text-danger");
      inputLengthText.classList.remove("text-muted");
    } else {
      inputLengthText.classList.add("text-muted");
      inputLengthText.classList.remove("text-danger");
    }

    inputLengthText.textContent = inputLength + " / 50";
  });

  window.dispatchEvent(new CustomEvent("ProfileSummaryFieldInput"));

  profileSummaryField.addEventListener("input", (event) => {
    window.dispatchEvent(new CustomEvent("ProfileSummaryFieldInput"));
  });
});
</script>
<?php $this->end(); ?>

