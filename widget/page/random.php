<?= self::widget('page', [
    'limit' => $limit ?? 5,
    'shake' => true,
    'title' => $title ?? i('Random %s', ['Posts'])
]);