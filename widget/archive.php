<?php

$content = "";

if (isset($state->x->archive)) {
    $archives = [];
    $x_archive_path = $state->x->archive->path ?? '/archive';
    $x_page_path = $path ?? $state->pathBlog;
    foreach (g(LOT . DS . 'page' . $x_page_path, 'page') as $k => $v) {
        $page = new Page($k);
        $v = $page->time;
        if ($v) {
            $v = explode('-', $v);
            $archives[$v[0]][$v[1]][] = 1;
        }
    }
    $dates = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ];
    if ($site->is('archives')) {
        $current = $archive->format('Y-m');
    }
    krsort($archives);
    foreach ($archives as $k => $v) {
        $k = (string) $k;
        if (!isset($current)) {
            $current = $k;
        }
        $content .= '<details class="archive' . (($open = $k === explode('-', $current)[0]) ? ' current' : "") . '"' . ($open ? ' open' : "") . '>';
        $content .= '<summary>';
        $content .= '<a href="' . $url . $x_page_path . $x_archive_path . '/' . $k . '/1">';
        $content .= $k . ' <span class="count">' . count($v) . '</span>';
        $content .= '</a>';
        $content .= '</summary>';
        if (is_array($v)) {
            krsort($v);
            $content .= '<ul>';
            foreach ($v as $kk => $vv) {
                $content .= '<li' . ($k . '-' . $kk === $current ? ' class="current"' : "") . '>';
                $content .= '<a href="' . $url . $x_page_path . $x_archive_path . '/' . $k . '-' . $kk . '/1">';
                $content .= $k . ' ' . i($dates[((int) $kk) - 1]) . ' <span class="count">' . count($vv) . '</span>';
                $content .= '</a>';
                $content .= '</li>';
            }
            $content .= '</ul>';
        }
        $content .= '</details>';
    }
} else {
    $content .= '<p>' . i('Missing %s extension.', ['<a href="https://mecha-cms.com/store/extension/archive" target="_blank">archive</a>']) . '</p>';
}

echo self::widget([
    'title' => $title ?? i('Archives'),
    'content' => $content ?: '<p>' . i('No %s yet.', ['posts']) . '</p>'
]);
