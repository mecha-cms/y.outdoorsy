<?php

$content = "";

if (isset($state->x->search)) {
    $to = $url . ($route ?? $state->routeBlog);
    $value = $_GET[$key = $state->x->search->key ?? 'query'] ?? null;
    $content .= '<form action="' . eat($to) . '" method="get" name="search" role="search">';
    $content .= '<p>';
    $content .= '<input name="' . eat($key) . '" type="text"' . (null !== $value ? ' value="' . eat($value) . '"' : "") . '>';
    $content .= ' ';
    $content .= '<button type="submit">' . i('Search') . '</button>';
    $content .= '</p>';
    $content .= '</form>';
} else {
    $content .= '<p role="status">' . i('Missing %s extension.', ['<a href="https://mecha-cms.com/store/extension/search" target="_blank">search</a>']) . '</p>';
}

echo self::widget([
    'content' => $content,
    'title' => $title ?? i('Search')
]);