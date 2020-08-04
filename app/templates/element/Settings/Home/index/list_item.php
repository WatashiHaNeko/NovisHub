<?php
$url = !empty($url) ? $url : '';
$label = !empty($label) ? $label : '';
$value = !empty($value) ? $value : '';
?>

<a href="<?= $url ?>" class="list-group-item list-group-item-action">
  <div class="row g-2 align-items-center">
    <div class="col">
      <div class="row justify-content-between">
        <div class="col">
          <?= $label ?>
        </div>

        <div class="col-auto text-right text-muted">
          <?= $value ?>
        </div>
      </div>
    </div>

    <svg width="1em" height="1em" viewBox="0 0 16 16" class="col-auto" fill="currentColor">
      <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
    </svg>
  </div>
</a>

