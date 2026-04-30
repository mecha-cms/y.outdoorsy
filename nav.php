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
        <a href="<?= eat($link->home); ?>">
          <?= i('Home'); ?>
        </a>
      <?php endif; ?>
    </li>
    <?php foreach ($data[0] as $v): ?>
      <li>
        <?php if ($v->current): ?>
          <a aria-current="page">
            <?= $v->title; ?>
          </a>
        <?php else: ?>
          <a href="<?= eat(first($v->links ?? []) ?? ($v->link . (q($v->children) ? '/1' : ""))); ?>">
            <?= $v->title; ?>
          </a>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>
</nav>