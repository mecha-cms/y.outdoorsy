<?php

$content = "";

if (isset($state->x->search)) {
    $to = $url . ($path ?? $state->pathBlog);
    $value = Get::get($key = $state->x->search->key ?? 'q');
    $content .= '<form action="' . $to . '" class="form-search" method="get">';
    $content .= '<p>';
    $content .= '<input name="' . $key . '" class="input" type="text"' . ($value ? ' value="' . From::HTML($value) . '"' : "") . '>';
    $content .= ' ';
    $content .= '<button class="button" type="submit">' . i('Search') . '</button>';
    $content .= '</p>';
    $content .= '</form>';
} else {
    $content .= '<p>' . i('Missing %s extension.', ['<a href="https://mecha-cms.com/store/extension/search" target="_blank">search</a>']) . '</p>';
}

echo self::widget([
    'title' => $title ?? i('Search'),
    'content' => $content
]);