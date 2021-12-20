<?= self::before(); ?>
<article class="page" id="page:0">
  <header>
    <h2>
      <?= i('Error'); ?> 404
    </h2>
  </header>
  <div>
    <p>
      <?= i('This %s does not exist.', ['page']); ?>
    </p>
  </div>
</article>
<?= self::after(); ?>