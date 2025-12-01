<?php

if (isset($state->x->tag)) {
    $deep = 0;
    $folder = LOT . D . 'page' . ($route ?? $state->routeBlog ?? '/article');
    if ($file = exist([
        $folder . '.archive',
        $folder . '.page'
    ], 1)) {
        $deep = (new Page($file))->deep ?? 0;
    }
    $a = $list = [];
    foreach (Pages::from($folder, 'page', $deep) as $v) {
        $a = array_merge($a, (array) $v->kind);
    }
    $current = (lot('tag')->url ?? "") . '/';
    foreach (array_count_values($a) as $k => $v) {
        if ($name = To::tag($k)) {
            if (is_file($f = LOT . D . 'tag' . D . $name . '.page')) {
                $tag = new Tag($f, ['parent' => $file ?: null]);
                $list[$t = $tag->title] = '<a' . (0 === strpos($current, ($k = $tag->url) . '/') ? ' aria-current="true"' : "") . ' href="' . $k . '" rel="tag">' . $t . '</a> <span aria-label="' . eat(i('%d post' . (1 === $v ? "" : 's'), [$v])) . '" role="status">(' . $v . ')</span>';
            }
        }
    }
    ksort($list);
    echo $list ? self::widget('list', [
        'list' => array_values($list),
        'title' => $title ?? i('Tags')
    ]) : self::widget([
        'content' => '<p role="status">' . i('No %s yet.', ['tags']) . '</p>',
        'title' => $title ?? i('Tags')
    ]);
} else {
    echo self::widget([
        'content' => '<p role="status">' . i('Missing %s extension.', ['<a href="https://mecha-cms.com/store/extension/tag" target="_blank">tag</a>']) . '</p>',
        'title' => $title ?? i('Tags')
    ]);
}