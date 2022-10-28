<nav class="pager">
  <ul>
    <li>
      <?php if ($prev = $pager->prev): ?>
        <a href="<?= From::HTML(($prev->link ?? $prev->url ?? "") . $url->query . $url->hash); ?>" rel="prev">
          <?= i('Newer'); ?>
        </a>
      <?php endif; ?>
    </li>
    <li>
      <?php if ($parent = $pager->parent): ?>
        <a href="<?= From::HTML(($parent->link ?? $parent->url ?? "") . $url->query . $url->hash); ?>">
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
        <a href="<?= From::HTML(($next->link ?? $next->url ?? "") . $url->query . $url->hash); ?>" rel="next">
          <?= i('Older'); ?>
        </a>
      <?php endif; ?>
    </li>
  </ul>
</nav>