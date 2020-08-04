<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">

    <?= $this->fetch('meta') ?>

    <?= $this->Html->css('https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css', [
      'integrity' => 'sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I',
      'crossorigin' => 'anonymous',
    ]) ?>

    <?= $this->fetch('css') ?>
  </head>

  <body>
    <header class="navbar navbar-expand navbar-light bg-light">
      <nav class="container-xxl flex-wrap flex-md-nowrap">
        <a href="<?= $this->Url->build([
          'prefix' => false,
          'controller' => 'Home',
          'action' => 'index',
        ]) ?>" class="navbar-brand p-0 mr-2">
          <?= __('Novis Hub') ?>
        </a>

        <div class="navbar-nav-scroll d-flex">
          <ul class="navbar-nav">
          </ul>
        </div>

        <div class="btn-toolbar">
          <div class="btn-group">
            <?php if (empty($authUser)): ?>
            <a href="<?= $this->Url->build([
              'prefix' => false,
              'controller' => 'Users',
              'action' => 'signup',
            ]) ?>" class="btn btn-outline-primary">
              <?= vsprintf('%s / <small>%s</small>', [
                __('アカウント登録'),
                __('ログイン'),
              ]) ?>
            </a>

            <?php else: ?>

            <a href="<?= $this->Url->build([
              'prefix' => 'Settings',
              'controller' => 'Home',
              'action' => 'index',
            ]) ?>" class="btn btn-outline-secondary">
              <?= __('{0}さん', $authUser['name']) ?>
            </a>
            <?php endif; ?>
          </div>
        </div>
      </nav>
    </header>

    <main class="main">
      <div class="container">
        <?= $this->Flash->render() ?>

        <?= $this->fetch('content') ?>
      </div>
    </main>

    <footer>
    </footer>

    <?= $this->fetch('modal') ?>

    <?= $this->fetch('postLink') ?>

    <?= $this->Html->script('https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', [
      'integrity' => 'sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo',
      'crossorigin' => 'anonymous',
    ]) ?>

    <?= $this->Html->script('https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js', [
      'integrity' => 'sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/',
      'crossorigin' => 'anonymous',
    ]) ?>
 
    <?= $this->fetch('script') ?>
  </body>
</html>

