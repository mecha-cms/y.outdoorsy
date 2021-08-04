<?= isset($state->x->view) ? self::widget('page', [
    'title' => $title ?? i('Popular %s', ['Posts']),
    'take' => $take ?? 5,
    'sort' => [-1, 'view']
]) : self::widget([
    'title' => $title ?? i('Popular %s', ['Posts']),
    'content' => '<p>' . i('Missing %s extension.', ['<a href="https://mecha-cms.com/store/extension/view" target="_blank">view</a>']) . '</p>'
]);
