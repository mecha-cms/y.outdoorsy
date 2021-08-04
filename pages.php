<?= self::before(); ?>
<?php foreach ($pages as $page): ?>
  <article class="page" id="page:<?= $page->id; ?>">
    <header>
      <?php if ($title = $page->title): ?>
        <h3>
          <?php if ($link = $page->link): ?>
            <a href="<?= $link; ?>" target="_blank">
              &#x2BB3; <?= $title; ?>
            </a>
          <?php else: ?>
            <a href="<?= $page->url; ?>">
              <?= $title; ?>
            </a>
          <?php endif; ?>
        </h3>
      <?php endif; ?>
      <p>
        <time datetime="<?= $page->time->format('c'); ?>">
          <?= $page->time->{r('-', '_', $site->language)}; ?>
        </time>
      </p>
    </header>
    <div>
      <?php if (!$excerpt = $page->excerpt): ?>
        <?php $excerpt = '<p>' . To::excerpt($page->content, true, 200) . '</p>'; ?>
      <?php endif; ?>
      <?= preg_replace('/<a(\s[^>]*?)?>|<\/a>/', "", $excerpt); ?>
      <p>
        <a href="<?= $page->url; ?>#next:<?= $page->id; ?>">
          <?= i('Read More'); ?>
        </a>
      </p>
    </div>
  </article>
<?php endforeach; ?>
<?= self::pager(); ?>
<?= self::after(); ?>
