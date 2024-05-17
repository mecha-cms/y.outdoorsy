<?= self::enter(); ?>
<?php if ($page->exist): ?>
  <article class="page" id="page:<?= eat($page->id); ?>">
    <header>
      <?php if ($title = $page->title): ?>
        <h2>
          <?= $title; ?>
        </h2>
      <?php endif; ?>
      <?php if ($description = $page->description): ?>
        <p>
          <?= $description; ?>
        </p>
      <?php endif; ?>
    </header>
    <?php $date_time_format = $state->y->outdoorsy->page->timeFormat ?? '%F %T'; ?>
    <?php if ($pages->count): ?>
      <?php foreach ($pages as $page): ?>
        <article class="page" id="page:<?= eat($page->id); ?>">
          <header>
            <?php if ($title = $page->title): ?>
              <h3>
                <?php if ($link = $page->link): ?>
                  <a href="<?= eat($link); ?>" target="_blank">
                    &#x27a0; <?= $title; ?>
                  </a>
                <?php else: ?>
                  <a href="<?= eat($page->url); ?>">
                    <?= $title; ?>
                  </a>
                <?php endif; ?>
              </h3>
            <?php endif; ?>
            <p>
              <time datetime="<?= eat($page->time->format('c')); ?>">
                <?= $page->time($date_time_format); ?>
              </time>
            </p>
          </header>
          <div>
            <?php if (!$excerpt = $page->excerpt): ?>
              <?php $excerpt = '<p>' . To::description($page->content, 250) . '</p>'; ?>
            <?php endif; ?>
            <?= preg_replace('/<a(\s[^>]*?)?>|<\/a>/', "", $excerpt); ?>
            <p>
              <a href="<?= eat($page->url); ?>#next:<?= eat($page->id); ?>">
                <?= i('Read More'); ?>
              </a>
            </p>
          </div>
        </article>
      <?php endforeach; ?>
    <?php else: ?>
      <?php if ($site->has('part')): ?>
        <p role="status">
          <?= i('No more %s to show.', 'pages'); ?>
        </p>
      <?php else: ?>
        <p role="status">
          <?= i('No %s yet.', 'pages'); ?>
        </p>
      <?php endif; ?>
    <?php endif; ?>
    <?= self::pager(); ?>
  </article>
<?php else: ?>
  <article class="page">
    <header>
      <h2>
        <?= i('Error'); ?>
      </h2>
    </header>
    <div>
      <p role="status">
        <?= i('%s does not exist.', 'Page'); ?>
      </p>
    </div>
  </article>
<?php endif; ?>
<?= self::exit(); ?>