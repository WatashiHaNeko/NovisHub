<?php
$this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/uuid/8.1.0/uuidv4.min.js', [
  'block' => true,
]);
?>

<div class="my-5 row justify-content-center">
  <div class="col-12 col-md-8 col-lg-6">
    <div class="card mb-2">
      <div class="card-body">
        <?= $this->Form->create($user, ['novalidate' => true]) ?>
          <div class="mb-3">
            <label class="form-label">
              <?= __('設定済みの検索用タグ') ?>
            </label>

            <div id="tags-container"></div>
          </div>

          <div class="mb-3">
            <label class="form-label">
              <?= __('追加する検索用タグ') ?>
            </label>

            <input list="tag-datalist" id="tag-label-field" class="mb-2 form-control">

            <div id="tags-to-add-container"></div>
          </div>

          <div class="mb-3">
            <label class="form-label">
              <?= __('削除する検索用タグ') ?>
            </label>

            <div id="tags-to-remove-container"></div>
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

<datalist id="tag-datalist"></datalist>

<?php $this->append('script'); ?>
<script>
window.addEventListener("DOMContentLoaded", (event) => {
  const tagLabelField = document.querySelector("#tag-label-field");
  const tagsToAddContainer = document.querySelector("#tags-to-add-container");
  const tagsToRemoveContainer = document.querySelector("#tags-to-remove-container");
  const tagsContainer = document.querySelector("#tags-container");
  const tagDatalist = document.querySelector("#tag-datalist");

  class Tag {
    constructor({ action, id, label }) {
      this.uuid = uuidv4();
      this.action = action;
      this.id = id;
      this.label = label;

      this.idField = document.createElement("input");

      this.idField.type = "hidden";
      this.idField.value = this.id;

      this.labelField = document.createElement("input");

      this.labelField.type = "hidden";
      this.labelField.value = this.label;

      this.badge = document.createElement("span");

      this.badge.textContent = this.label;

      this.badge.classList.add("mx-1");
      this.badge.classList.add("badge");
      this.badge.appendChild(this.idField);
      this.badge.appendChild(this.labelField);
      this.badge.addEventListener("click", this._handleBadgeClick.bind(this));
      this.badge.addEventListener("touchend", this._handleBadgeClick.bind(this));

      this._render();
    }

    _render() {
      this.idField.name = "Tags[" + this.action + "][" + this.uuid + "][id]";

      this.labelField.name = "Tags[" + this.action + "][" + this.uuid + "][label]";

      if (this.action === false) {
        this.badge.classList.remove("bg-danger");
        this.badge.classList.add("bg-secondary");

        tagsContainer.appendChild(this.badge);
      } else if (this.action === "add") {
        this.badge.classList.add("bg-primary");

        tagsToAddContainer.appendChild(this.badge);
      } else if (this.action === "remove") {
        this.badge.classList.remove("bg-secondary");
        this.badge.classList.add("bg-danger");

        tagsToRemoveContainer.appendChild(this.badge);
      }
    }

    _handleBadgeClick() {
      if (this.action === false) {
        this.action = "remove";

        this._render();
      } else if (this.action === "add") {
        this.badge.remove();
      } else if (this.action === "remove") {
        this.action = false;

        this._render();
      }
    }
  }

  tagLabelField.addEventListener("keydown", (event) => {
    if (event.key !== "Enter") {
      return;
    }

    event.preventDefault();

    const label = tagLabelField.value.trim();

    if (label === "") {
      return;
    }

    const tag = new Tag({
      action: "add",
      id: null,
      label,
    });

    tagLabelField.value = "";

    return false;
  });

  <?php foreach ($userTags as $userTag): ?>
  (() => {
    const tag = new Tag({
      action: false,
      id: <?= $userTag['tag']['id'] ?>,
      label: "<?= h($userTag['tag']['label']) ?>",
    });
  })();
  <?php endforeach; ?>

  fetch("<?= $this->Url->build([
    'prefix' => 'Api',
    'controller' => 'Tags',
    'action' => 'index',
    '_ext' => 'json',
  ]) ?>").catch((error) => {}).then(async (response) => {
    const responseData = await response.json();

    if (responseData.success) {
      const fragment = document.createDocumentFragment();

      for (const tag of responseData.data.tags) {
        const option = document.createElement("option");

        option.value = tag.label;

        fragment.appendChild(option);
      }

      tagDatalist.appendChild(fragment);
    }
  });
});
</script>
<?php $this->end(); ?>

