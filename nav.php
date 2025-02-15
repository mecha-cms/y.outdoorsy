<h2>
  <?= i('Navigation'); ?>
</h2>
<nav class="nav">
  <ul>
    <li>
      <?php if ($site->is('home')): ?>
        <a aria-current="page">
          <?= i('Home'); ?>
        </a>
      <?php else: ?>
        <a href="<?= $url; ?>">
          <?= i('Home'); ?>
        </a>
      <?php endif; ?>
    </li>
    <?php foreach ($links as $link): ?>
      <li>
        <?php if ($link->current): ?>
          <a aria-current="page">
            <?= $link->title; ?>
          </a>
        <?php else: ?>
          <?php $children = $link->children ?? false; ?>
          <a href="<?= eat($link->link ?: ($link->url . ($children && $children->count ? '/1' : ""))); ?>">
            <?= $link->title; ?>
          </a>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>
</nav>