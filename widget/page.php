<?php

$pages = [];
$pages_data = Pages::from(LOT . DS . 'page' . ($path ?? $state->pathBlog))->sort([$sort[0] ?? -1, $sort[1] ?? 'time']);

if (!empty($shake)) {
    $pages_data->shake();
}

foreach ($pages_data->chunk($take ?? 5, 0) as $page) {
    $pages[$page->url] = $page->title;
}

echo $pages ? self::widget('list', [
    'title' => $title ?? "",
    'lot' => $pages
]) : self::widget([
    'title' => $title ?? "",
    'content' => '<p>' . i('No %s yet.', ['posts']) . '</p>'
]);