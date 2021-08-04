<?php

$content = "";

if (!isset($current)) {
    $current = $url->current;
}

if (!isset($target)) {
    $target = "";
}

if (!empty($lot['lot'])) {
    $content .= '<ul>';
    foreach ((array) $lot['lot'] as $k => $v) {
        if ($k === $current) {
            $content .= '<li class="current">';
        } else {
            $content .= '<li>';
        }
        if (false !== strpos($k, '://')) {
            $content .= '<a href="' . $k . '"' . ($target ? ' target="' . $target . '"' : "") . '>';
            $content .= $v;
            $content .= '</a>';
        } else {
            $content .= $v;
        }
        $content .= '</li>';
    }
    $content .= '</ul>';
}

echo self::widget([
    'title' => $title ?? "",
    'content' => $content
]);
