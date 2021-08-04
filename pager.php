<nav class="pager">
  <ul>
    <li>
      <?php if ($prev = $pager->prev): ?>
        <a href="<?= $prev->link ?? $prev->url; ?>" rel="prev">
          <?= i('Newer'); ?>
        </a>
      <?php endif; ?>
    </li>
    <li>
      <?php if ($parent = $pager->parent): ?>
        <a href="<?= $parent->link ?? $parent->url; ?>">
          <?= i('Parent'); ?>
        </a>
      <?php elseif (!$site->is('home')): ?>
        <a href="<?= $url; ?>">
          <?= i('Home'); ?>
        </a>
      <?php endif; ?>
    </li>
    <li>
      <?php if ($next = $pager->next): ?>
        <a href="<?= $next->link ?? $next->url; ?>" rel="next">
          <?= i('Older'); ?>
        </a>
      <?php endif; ?>
    </li>
  </ul>
</nav>
