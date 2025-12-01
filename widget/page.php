<?php

$deep = 0;
$folder = LOT . D . 'page' . ($route ?? $state->routeBlog ?? '/article');
if ($file = exist([
    $folder . '.archive',
    $folder . '.page'
], 1)) {
    $deep = (new Page($file))->deep ?? 0;
}

$list = [];
$pages = Pages::from($folder, 'page', $deep)->sort([$sort[0] ?? -1, $sort[1] ?? 'time']);

if (!empty($shake)) {
    $pages = $pages->shake();
}

$current = (lot('page')->url ?? "") . '/';
foreach ($pages->chunk($take ?? 5, 0) as $page) {
    $list[] = '<a' . (0 === strpos($current, ($k = $page->url) . '/') ? ' aria-current="true"' : "") . ' href="' . $k . '">' . $page->title . '</a>';
}

echo $list ? self::widget('list', [
    'list' => $list,
    'title' => $title ?? ""
]) : self::widget([
    'content' => '<p role="status">' . i('No %s yet.', ['posts']) . '</p>',
    'title' => $title ?? ""
]);