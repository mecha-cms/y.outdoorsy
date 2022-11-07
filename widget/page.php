<?php

$pages = [];
$pages_data = Pages::from(LOT . D . 'page' . ($route ?? $state->routeBlog))->sort([$sort[0] ?? -1, $sort[1] ?? 'time']);

if (!empty($shake)) {
    $pages_data->shake();
}

foreach ($pages_data->chunk($take ?? 5, 0) as $page) {
    $pages[$page->url] = $page->title;
}

echo $pages ? self::widget('list', [
    'lot' => $pages,
    'title' => $title ?? ""
]) : self::widget([
    'content' => '<p role="status">' . i('No %s yet.', ['posts']) . '</p>',
    'title' => $title ?? ""
]);