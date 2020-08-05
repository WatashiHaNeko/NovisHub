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

<div class="my-3">
  <div class="row">
    <div class="col-md-4 d-flex flex-column align-items-center">
      <img src="<?= $user->getAvatarUrl() ?>" class="d-block mb-3" style="<?= $this->Html->style([
        'width' => '120px',
        'height' => '120px',
        'border-radius' => '50%',
      ]) ?>">

      <h2 class="h5">
        <?= h($user['name']) ?>
      </h2>
    </div>

    <div class="col-md-8">
      <?php if (!empty($user['profile'])): ?>
      <div id="markdown-text" class="markdown-body">
        <?= $this->Markdown->parse($user['profile']) ?>
      </div>
      <?php else: ?>
      <div>
        <?= __('まだ{0}が登録されていません。', __('プロフィール')) ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php $this->append('script'); ?>
<script>
window.addEventListener("DOMContentLoaded", (event) => {
  const markdownText = document.querySelector("#markdown-text");

  markdownText.querySelectorAll("pre code").forEach((block) => {
    hljs.highlightBlock(block);
  });
});
</script>
<?php $this->end(); ?>

