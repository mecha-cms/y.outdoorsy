<nav class="pager">
  <ul>
    <li>
      <?php if ($prev = $pager->prev): ?>
        <a href="<?= $prev->link; ?>" rel="prev" title="<?= w($prev->description); ?>">
          <?= i('Newer'); ?>
        </a>
      <?php endif; ?>
    </li>
    <li>
      <?php if ($parent = $page->parent): ?>
        <a href="<?= $parent->url; ?>" title="<?= w($parent->description); ?>">
          <?= $parent->title ?? i('Parent'); ?>
        </a>
      <?php else: ?>
        <?php if (!$site->is('home')): ?>
          <a href="<?= $url; ?>">
            <?= i('Home'); ?>
          </a>
        <?php endif; ?>
      <?php endif; ?>
    </li>
    <li>
      <?php if ($next = $pager->next): ?>
        <a href="<?= $next->link; ?>" rel="next" title="<?= w($next->description); ?>">
          <?= i('Older'); ?>
        </a>
      <?php endif; ?>
    </li>
  </ul>
</nav>