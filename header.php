<header class="header">
  <h1>
    <?php if ($site->is('home')): ?>
      <a aria-current="page">
        <?= $site->title; ?>
      </a>
    <?php else: ?>
      <a href="<?= $url; ?>">
        <?= $site->title; ?>
      </a>
    <?php endif; ?>
  </h1>
  <p>
    <?= $site->description; ?>
  </p>
</header>