<?php

$z = defined('TEST') && TEST ? '.' : '.min.';
Asset::set(__DIR__ . D . 'index' . $z . 'css', 20);

$GLOBALS['links'] = new Anemone((static function ($links, $state, $url) {
    $index = LOT . D . 'page' . D . trim(strtr($state->route, '/', D), D) . '.page';
    $path = $url->path . '/';
    foreach (g(LOT . D . 'page', 'page') as $k => $v) {
        // Exclude home page
        if ($k === $index) {
            continue;
        }
        $v = new Page($k);
        // Add current state
        $v->current = 0 === strpos($path, '/' . $v->name . '/');
        $links[$k] = $v;
    }
    ksort($links);
    return $links;
})([], $state, $url));

$defaults = [
    'route-blog' => '/article',
    'x.comment.page.type' => 'Markdown',
    'x.page.page.type' => 'Markdown'
];

foreach ($defaults as $k => $v) {
    !State::get($k) && State::set($k, $v);
}

if (!empty($state->y->outdoorsy->page->header) && $state->is('pages')) {
    State::set('with.page-header', true);
}

if (isset($state->x->alert)) {
    if ($search = trim(strip_tags(isset($state->x->search) ? ($_GET[$state->x->search->key ?? 'query'] ?? "") : ""))) {
        Hook::set('route.search', function ($content, $path, $query, $hash) use ($search, $state) {
            if (!$state->is('archives') && !$state->is('tags')) {
                Alert::info('Showing %s matched with query %s.', ['posts', '<em>' . $search . '</em>']);
            }
        });
    }
    Hook::set('route.archive', function ($content, $path, $query, $hash) use ($search, $state) {
        $data = From::query($query);
        if ($name = $data['name'] ?? "") {
            $archive = new Time(substr_replace('1970-01-01-00-00-00', $name, 0, strlen($name)));
            $format = (false === strpos($name, '-') ? "" : '%B ') . '%Y';
            if ($search) {
                Alert::info('Showing %s published in %s and matched with query %s.', ['posts', '<em>' . $archive->i($format) . '</em>', '<em>' . $search . '</em>']);
            } else {
                Alert::info('Showing %s published in %s.', ['posts', '<em>' . $archive->i($format) . '</em>']);
            }
        }
    });
    Hook::set('route.tag', function ($content, $path, $query, $hash) use ($search, $state) {
        $data = From::query($query);
        if ($name = $data['name'] ?? "") {
            if (is_file($file = LOT . D . 'tag' . D . $name . '.page')) {
                $tag = new Tag($file);
                if ($search) {
                    Alert::info('Showing %s tagged in %s and matched with query %s.', ['posts', '<em>' . $tag->title . '</em>', '<em>' . $search . '</em>']);
                } else {
                    Alert::info('Showing %s tagged in %s.', ['posts', '<em>' . $tag->title . '</em>']);
                }
            }
        }
    });
    Hook::set('y.alert', function ($alert) {
        foreach ($alert[1] as &$v) {
            $v[2]['aria-live'] = ['error' => 'assertive', 'info' => 'off', 'success' => 'polite'][$v[2]['type'] ?? $v['type']] ?? null;
        }
        unset($v);
        return $alert;
    });
}

if (isset($state->x->excerpt) && $state->is('page')) {
    Hook::set('page.content', function ($content) {
        return null !== $content ? strtr($content, ["\f" => '<hr id="next:' . $this->id . '" role="doc-pagebreak">']) : null;
    });
}