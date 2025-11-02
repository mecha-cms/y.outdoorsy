<?php

if (isset($state->x->tag)) {
    $deep = 0;
    $folder = LOT . D . 'page' . ($route ?? $state->routeBlog ?? '/article');
    if ($file = exist([
        $folder . '.archive',
        $folder . '.page'
    ], 1)) {
        $page = new Page($file);
        $deep = $page->deep ?? 0;
    }
    $tags = [];
    $tags_all = [];
    foreach (g($folder, 'page', $deep) as $k => $v) {
        $page = new Page($k);
        $v = (array) ($page->kind ?? []);
        $v && ($tags_all = array_merge($tags_all, $v));
    }
    foreach (array_count_values($tags_all) as $k => $v) {
        if ($name = To::tag($k)) {
            if (is_file($f = LOT . D . 'tag' . D . $name . '.page')) {
                $tag = new Tag($f, ['parent' => $file ?: null]);
                $tags[$tag->url] = $tag->title . ' <span aria-label="' . eat(i('%d post' . (1 === $v ? "" : 's'), [$v])) . '" role="status">' . $v . '</span>';
            }
        }
    }
    asort($tags);
    echo $tags ? self::widget('list', [
        'current' => lot('tag')->url ?? null,
        'lot' => $tags,
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