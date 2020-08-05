<div class="mb-5 py-3 py-md-5">
  <h1 class="mb-3 text-center text-md-left">
    <?= __('We are developers.<br>We are buddies.') ?>
  </h1>

  <p class="lead mb-4 text-center text-md-left text-muted">
    <?= __('{0}は駆け出しエンジニアが仲間を見つけるための場所。<br>似たような興味を持ってる人や悩みを持っている人を探してみよう。', __('Novis Hub')) ?>
  </p>

  <div class="d-flex flex-column flex-md-row">
    <a href="<?= $this->Url->build([
    ]) ?>" class="mr-md-3 mb-3 mb-md-0 btn btn-primary btn-lg">
      <?= vsprintf('%s / %s', [
        __('ログイン'),
        __('新規登録'),
      ]) ?>
    </a>
  </div>
</div>

<div class="row mb-5 pb-md-4">
  <div class="col-md-4 mb-4 mb-md-0">
    <div class="mb-2 text-center text-md-left">
      <svg width="4em" height="4em" viewBox="0 0 16 16" class="rounded-lg text-primary" fill="currentColor">
        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path fill-rule="evenodd" d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM6.5 6.497V6.5h-1c0-.568.447-.947.862-1.154C6.807 5.123 7.387 5 8 5s1.193.123 1.638.346c.415.207.862.586.862 1.154h-1v-.003l-.003-.01a.213.213 0 0 0-.036-.053.86.86 0 0 0-.27-.194C8.91 6.1 8.49 6 8 6c-.491 0-.912.1-1.19.24a.86.86 0 0 0-.271.194.213.213 0 0 0-.036.054l-.003.01z"/>
        <path d="M2.31 5.243A1 1 0 0 1 3.28 4H6a1 1 0 0 1 1 1v1a2 2 0 0 1-2 2h-.438a2 2 0 0 1-1.94-1.515L2.31 5.243zM9 5a1 1 0 0 1 1-1h2.72a1 1 0 0 1 .97 1.243l-.311 1.242A2 2 0 0 1 11.439 8H11a2 2 0 0 1-2-2V5z"/>
      </svg>
    </div>

    <h2 class="display-5 font-weight-normal text-center text-md-left">
      <?= __('新しく登録した駆け出しエンジニア') ?>
    </h2>

    <div class="text-right text-md-left">
      <a href="<?= $this->Url->build([
        'controller' => 'Users',
        'action' => 'index',
      ]) ?>" class="btn btn-sm btn-outline-info">
        <?= __('もっと見る・検索') ?>

        <svg width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor">
          <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
          <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
        </svg>
      </a>
    </div>
  </div>

  <div class="col-md-8">
    <?php foreach ($users as $user): ?>
    <?= $this->element('user_card', [
      'user' => $user,
    ]) ?>
    <?php endforeach; ?>
  </div>
</div>

