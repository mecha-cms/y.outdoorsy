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
        $content .= '<li>';
        if (false !== strpos($k, '://')) {
            $content .= '<a' . ($k === $current ? ' aria-current="page"' : "") . ' href="' . $k . '"' . ($target ? ' target="' . $target . '"' : "") . '>';
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
    'content' => $content,
    'title' => $title ?? ""
]);