<!DOCTYPE html>
<html class>
  <head>
    <meta charset="utf-8">
    <meta content="width=1024" name="viewport">
    <?php if ($v = w($page->description ?? $site->description ?? "")): ?>
      <meta content="<?= $v; ?>" name="description">
    <?php endif; ?>
    <meta content="<?= eat($page->author); ?>" name="author">
    <title>
      <?= w($t->reverse); ?>
    </title>
    <link href="<?= eat($link->base('/favicon.ico')); ?>" rel="icon">
    <link href="<?= eat($link->current(false, false)); ?>" rel="canonical">
  </head>
  <body>
    <div class="body">
      <?= self::header(); ?>
      <?= self::nav(); ?>
      <div class="content">
        <main class="main">
          <?= self::alert(); ?>