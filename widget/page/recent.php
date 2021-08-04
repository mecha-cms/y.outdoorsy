<?= self::widget('page', [
    'title' => $title ?? i('Recent %s', ['Posts']),
    'take' => $take ?? 5,
    'sort' => [-1, 'time']
]);
