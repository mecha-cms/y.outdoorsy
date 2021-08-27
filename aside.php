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
      'title' => i('Social Links'),
      'lot' => [
          'https://facebook.com/ta.tau.taufik' => 'Facebook',
          'https://github.com/taufik-nurrohman' => 'GitHub',
          'https://instagram.com/ta.tau.taufik' => 'Instagram',
          'https://open.spotify.com/user/21ar3ejto7p7p3ybiq5obhrpq' => 'Spotify',
          'https://t.me/taufik_nurrohman' => 'Telegram',
          'https://twitter.com/ta_tau_taufik' => 'Twitter'
      ]
  ]); ?>
</aside>