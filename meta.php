<?php if (q($data[2])): ?>
  <h2>
    <?= i('Links'); ?>
  </h2>
  <ul>
    <?php foreach ($data[2] as $v): ?>
      <li>
        <a href="<?= eat($v->link); ?>">
          <?= $v->title; ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>