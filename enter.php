<!DOCTYPE html>
<html class>
  <head>
    <meta charset="utf-8">
    <meta content="width=1024" name="viewport">
    <?php if ($w = w($page->description ?? $site->description ?? "")): ?>
      <meta content="<?= $w; ?>" name="description">
    <?php endif; ?>
    <?php if ('archive' === $page->x): ?>
      <!-- Prevent search engines from indexing pages with `archive` state -->
      <meta content="noindex" name="robots">
    <?php endif; ?>
    <meta content="<?= eat($page->author); ?>" name="author">
    <title>
      <?= w($t->reverse); ?>
    </title>
    <link href="<?= eat($url . '/favicon.ico'); ?>" rel="icon">
    <link href="<?= eat($url->current(false, false)); ?>" rel="canonical">
  </head>
  <body>
    <div class="body">
      <?= self::header(); ?>
      <?= self::nav(); ?>
      <div class="content">
        <main class="main">
          <?= self::alert(); ?>
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