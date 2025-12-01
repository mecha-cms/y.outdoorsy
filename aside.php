<aside class="aside">
  <?= self::widget('form/search'); ?>
  <?= self::widget('archive'); ?>
  <?= self::widget('tag'); ?>
  <?php if ($site->is('home')): ?>
    <?= self::widget('page/random'); ?>
  <?php else: ?>
    <?= self::widget('page/recent'); ?>
  <?php endif; ?>
  <?= self::widget('list', [
      'list' => [
          '<a href="https://facebook.com/ta.tau.taufik" target="_blank">Facebook</a>',
          '<a href="https://github.com/taufik-nurrohman" target="_blank">GitHub</a>',
          '<a href="https://instagram.com/ta.tau.taufik" target="_blank">Instagram</a>',
          '<a href="https://open.spotify.com/user/21ar3ejto7p7p3ybiq5obhrpq" target="_blank">Spotify</a>',
          '<a href="https://t.me/taufik_nurrohman" target="_blank">Telegram</a>',
          '<a href="https://twitter.com/ta_tau_taufik" target="_blank">Twitter</a>'
      ],
      'title' => i('Social Links')
  ]); ?>
</aside>