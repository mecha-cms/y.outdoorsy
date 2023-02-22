<footer class="footer">
  <div class="function">
    <!-- You have to maintain this back link to support the theme designer, or visit this back link to find a legal way to remove it via the theme designer’s discretion. -->
    <?= i('Designed by %s', ['<a href="http://www.themespreview.com" rel="nofollow" target="_blank">Function</a>']); ?>
  </div>
  <div class="foot">
    <?= self::meta(); ?>
    <span class="rights">
      &#x00A9; <?= $date->year; ?> <a href="<?= eat($url); ?>">
        <?= $site->title; ?>
      </a> <span>
        <!-- You have to maintain this back link to support me, or make a proper donation to remove it. -->
        <?= i('Powered by %s', ['<a href="https://mecha-cms.com" rel="nofollow" target="_blank">Mecha ' . VERSION . '</a>']); ?>
      </span>
    </span>
  </div>
</footer>