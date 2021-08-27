<?= self::widget('page', [
    'title' => $title ?? i('Random %s', ['Posts']),
    'take' => $take ?? 5,
    'shake' => true
]);