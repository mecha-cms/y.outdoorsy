<?= isset($state->x->view) ? self::widget('page', [
    'sort' => [-1, 'view'],
    'take' => $take ?? 5,
    'title' => $title ?? i('Popular %s', ['Posts'])
]) : self::widget([
    'content' => '<p role="status">' . i('Missing %s extension.', ['<a href="https://mecha-cms.com/store/extension/view" target="_blank">view</a>']) . '</p>',
    'title' => $title ?? i('Popular %s', ['Posts'])
]);