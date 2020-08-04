<div class="my-3">
  <?php foreach ($users as $user): ?>
  <div class="card mb-2">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-auto">
          <img src="<?= $user->getAvatarUrl() ?>" class="d-block rounded" style="<?= $this->Html->style([
            'width' => '48px',
            'height' => '48px',
          ]) ?>">
        </div>

        <div class="col">
          <h5>
            <a href="<?= $this->Url->build([
              'action' => 'view',
              $user['id'],
            ]) ?>" class="link-dark">
              <?= h($user['name']) ?>
            </a>
          </h5>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>

  <ul class="pagination">
    <?= $this->Paginator->numbers([
      'modulus' => 2,
      'first' => 1,
      'last' => 1,
    ]) ?>
  </ul>
</div>

