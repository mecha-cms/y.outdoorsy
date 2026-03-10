<?php

$deep = 0;
$folder = LOT . D . 'page' . rawurldecode($route ?? $state->routeLog ?? '/article');
if ($file = exist(dirname($folder) . D . '{#,}' . basename($folder) . '.{' . ($x = x\page\x()) . '}', 1)) {
    $deep = (new Page($file))->deep ?? 0;
}

$list = [];
$pages = Pages::from($folder, $x, $deep)->sort([$sort[0] ?? -1, $sort[1] ?? 'time']);

if (!empty($shake)) {
    $pages = $pages->shake();
}

$current = (lot('page')->link ?? "") . '/';
foreach ($pages->limit($limit ?? 5) as $page) {
    $list[] = '<a' . (0 === strpos($current, ($k = $page->link) . '/') ? ' aria-current="true"' : "") . ' href="' . $k . '">' . $page->title . '</a>';
}

echo $list ? self::widget('list', [
    'list' => $list,
    'title' => $title ?? ""
]) : self::widget([
    'content' => '<p role="status">' . i('No %s yet.', ['posts']) . '</p>',
    'title' => $title ?? ""
]);