<?php

if (isset($state->x->tag)) {
    $tags = [];
    $tags_found = [];
    foreach (g($folder = LOT . D . 'page' . ($path ?? $state->routeBlog), 'page') as $k => $v) {
        $page = new Page($k);
        $v = (array) ($page->kind ?? []);
        $v && ($tags_found = array_merge($tags_found, $v));
    }
    foreach (array_count_values($tags_found) as $k => $v) {
        if ($n = To::tag($k)) {
            if (is_file($f = LOT . D . 'tag' . D . $n . '.page')) {
                $tag = new Tag($f, [
                    'parent' => exist([
                        $folder . '.archive',
                        $folder . '.page'
                    ], 1) ?: null
                ]);
                $tags[$tag->link] = $tag->title . ' <span aria-label="' . i('%d post' . (1 === $v ? "" : 's'), [$v]) . '" role="status">' . $v . '</span>';
            }
        }
    }
    asort($tags);
    echo $tags ? self::widget('list', [
        'current' => $GLOBALS['tag']->link ?? null,
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