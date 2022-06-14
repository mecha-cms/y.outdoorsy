<?php foreach (alert() as $v): ?>
  <p aria-live="<?= ['error' => 'assertive', 'info' => 'off', 'success' => 'polite'][$v[2]['type']] ?? ""; ?>" role="alert">
    <?= $v[1]; ?>
  </p>
<?php endforeach; ?>