<?php

$content = "";

if (isset($state->x->archive)) {
    $archives = [];
    $x_archive_route = $state->x->archive->route ?? '/archive';
    $x_page_route = $path ?? $state->routeBlog;
    foreach (g(LOT . D . 'page' . $x_page_route, 'page') as $k => $v) {
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
        $content .= '<details' . (($open = $k === explode('-', $current)[0]) ? ' open' : "") . ' role="tree">';
        $content .= '<summary aria-level="1" role="treeitem">';
        $content .= '<a' . ($open ? ' aria-current="page"' : "") . ' href="' . $url . $x_page_route . $x_archive_route . '/' . $k . '/1">';
        $content .= $k . ' <span aria-label="' . i('%d archive' . (1 === ($i = count($v)) ? "" : 's'), [$i]) . '" role="status">' . $i . '</span>';
        $content .= '</a>';
        $content .= '</summary>';
        if (is_array($v)) {
            krsort($v);
            $content .= '<ul role="group">';
            foreach ($v as $kk => $vv) {
                $content .= '<li aria-level="2" role="treeitem">';
                $content .= '<a' . ($k . '-' . $kk === $current ? ' aria-current="page"' : "") . ' href="' . $url . $x_page_route . $x_archive_route . '/' . $k . '-' . $kk . '/1">';
                $content .= $k . ' ' . i($dates[((int) $kk) - 1]) . ' <span aria-label="' . i('%d post' . (1 === ($ii = count($vv)) ? "" : 's'), [$ii]) . '" role="status">' . $ii . '</span>';
                $content .= '</a>';
                $content .= '</li>';
            }
            $content .= '</ul>';
        }
        $content .= '</details>';
    }
} else {
    $content .= '<p role="status">' . i('Missing %s extension.', ['<a href="https://mecha-cms.com/store/extension/archive" target="_blank">archive</a>']) . '</p>';
}

echo self::widget([
    'content' => $content ?: '<p role="status">' . i('No %s yet.', ['posts']) . '</p>',
    'title' => $title ?? i('Archives')
]);