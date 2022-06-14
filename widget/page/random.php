<?= self::widget('page', [
    'shake' => true,
    'take' => $take ?? 5,
    'title' => $title ?? i('Random %s', ['Posts'])
]);