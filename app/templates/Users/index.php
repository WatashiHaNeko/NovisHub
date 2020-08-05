<div class="my-3">
  <div class="row mb-3">
    <?= $this->Form->create(null, ['type' => 'get', 'novalidate' => true, 'class' => 'col-md-6']) ?>
      <?= $this->Form->hidden('tag_label', ['value' => $this->request->getQuery('tag_label')]) ?>
      <?= $this->Form->hidden('page', ['value' => 1]) ?>

      <div class="row g-1">
        <div class="col">
          <?= $this->Form->text('text', [
            'class' => 'form-control',
            'value' => $this->request->getQuery('text'),
          ]) ?>
        </div>

        <div class="col-auto">
          <button class="btn btn-primary">
            <?= __('検索') ?>
          </button>
        </div>
      </div>
    <?= $this->Form->end() ?>
  </div>

  <?php if (!empty($this->request->getQuery('tag_label'))): ?>
  <div class="row mb-3">
    <div class="col">
      <?= __('絞り込み中のタグ') ?>

      <span class="ml-2 badge bg-secondary">
        <?= $this->request->getQuery('tag_label') ?>
      </span>

      <a href="<?= $this->Url->build([
        '?' => [
          'page' => 1,
          'tag_label' => null,
        ] + $this->request->getQuery(),
      ]) ?>" class="link-danger" style="<?= $this->Html->style([
        'font-size' => '0.8em',
      ]) ?>">
        <?= __('タグの絞り込みを解除') ?>
      </a>
    </div>
  </div>
  <?php endif; ?>

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

          <?php if (!empty($user['user_tags'])): ?>
          <div>
            <?php foreach ($user['user_tags'] as $userTag): ?>
            <a href="<?= $this->Url->build([
              '?' => [
                'page' => 1,
                'tag_label' => $userTag['tag']['label'],
              ] + $this->request->getQuery(),
            ]) ?>" class="mb-2 badge bg-secondary link-light">
              <?= h($userTag['tag']['label']) ?>
            </a>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>

          <p class="mb-0 text-muted">
            <?= nl2br(h($user['profile_summary'])) ?>
          </p>
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

