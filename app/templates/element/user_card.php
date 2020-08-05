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
            'prefix' => false,
            'controller' => 'Users',
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
            'prefix' => false,
            'controller' => 'Users',
            'action' => 'index',
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

