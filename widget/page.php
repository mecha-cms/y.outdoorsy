<?php

$deep = 0;
$folder = LOT . D . 'page' . ($route ?? $state->routeBlog);
if ($file = exist([
    $folder . '.archive',
    $folder . '.page'
], 1)) {
    $page = new Page($file);
    $deep = $page->deep ?? 0;
}

$pages = [];
$pages_data = Pages::from($folder, 'page', $deep)->sort([$sort[0] ?? -1, $sort[1] ?? 'time']);

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