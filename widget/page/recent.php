<?= self::widget('page', [
    'sort' => [-1, 'time'],
    'take' => $take ?? 5,
    'title' => $title ?? i('Recent %s', ['Posts'])
]);