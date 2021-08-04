<?= self::before(); ?>
<article class="page" id="page:<?= $page->id; ?>">
  <header>
    <?php if ($title = $page->title): ?>
      <h2>
        <?= $title; ?>
      </h2>
    <?php endif; ?>
    <?php if ($site->has('page') && $site->has('parent')): ?>
      <p>
        <time datetime="<?= $page->time->format('c'); ?>">
          <?= $page->time->{r('-', '_', $site->language)}; ?>
        </time>
      </p>
    <?php endif; ?>
  </header>
  <div>
    <?= $page->content; ?>
    <?php if ($link = $page->link): ?>
      <p>
        <a class="button" href="<?= $link; ?>" rel="nofollow" target="_blank">
          <?= i('Direct Link'); ?>
        </a>
      </p>
    <?php endif; ?>
  </div>
  <?php if ($site->has('page') && $site->has('parent')): ?>
    <?= self::get('footer.page', ['page' => $page]); ?>
    <?php if (isset($state->x->comment)): ?>
      <?= self::comments(); ?>
    <?php endif; ?>
  <?php endif; ?>
</article>
<?= self::after(); ?>
