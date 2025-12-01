<?php

$content = "";

if (isset($state->x->archive)) {
    $archives = [];
    $deep = 0;
    $route_archive = $state->x->archive->route ?? '/archive';
    $route_blog = $route ?? $state->routeBlog ?? '/article';
    $folder = LOT . D . 'page' . $route_blog;
    if ($file = exist([
        $folder . '.archive',
        $folder . '.page'
    ], 1)) {
        $deep = (new Page($file))->deep ?? 0;
    }
    foreach (g($folder, 'page', $deep) as $k => $v) {
        if ($v = (new Page($k))->time) {
            $v = explode('-', (string) $v);
            $archives[$v[0]][$v[1]][] = 1;
        }
    }
    if ($site->is('archives') && isset($archive)) {
        $current = $archive->format('Y-m');
    } else if ($site->is('page') && isset($page)) {
        $current = $page->time->format('Y-m');
    }
    krsort($archives);
    foreach ($archives as $k => $v) {
        $k = (string) $k;
        if (!isset($current)) {
            $current = $k;
        }
        $content .= '<details' . (($open = $k === explode('-', $current)[0]) ? ' open' : "") . ' role="tree">';
        $content .= '<summary aria-level="1" role="treeitem">';
        $content .= '<a' . ($open ? ' aria-current="page"' : "") . ' href="' . eat(long($route_blog . $route_archive . '/' . $k . '/1')) . '">' . $k . '</a>';
        $content .= ' <span aria-label="' . eat(i('%d archive' . (1 === ($i = count($v)) ? "" : 's'), [$i])) . '" role="status">(' . $i . ')</span>';
        $content .= '</summary>';
        if (is_array($v)) {
            krsort($v);
            $content .= '<ul role="group">';
            foreach ($v as $kk => $vv) {
                $content .= '<li aria-level="2" role="treeitem">';
                $content .= '<a' . ($k . '-' . $kk === $current ? ' aria-current="page"' : "") . ' href="' . eat(long($route_blog . $route_archive . '/' . $k . '-' . $kk . '/1')) . '">' . $k . ' ' . i(date('F', mktime(0, 0, 0, $kk, 1))) . '</a>';
                $content .= ' <span aria-label="' . eat(i('%d post' . (1 === ($ii = count($vv)) ? "" : 's'), [$ii])) . '" role="status">(' . $ii . ')</span>';
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