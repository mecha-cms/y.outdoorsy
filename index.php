<?php

$z = defined('TEST') && TEST ? '.' : '.min.';
Asset::set(__DIR__ . D . 'index' . $z . 'css', 20);

$GLOBALS['links'] = new Anemone((static function($links, $state, $url) {
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
    Hook::set('route.archive', function($content, $path, $query, $hash, $data) {
        $archive = new Time(substr_replace('1970-01-01-00-00-00', $name = $data['name'], 0, strlen($name)));
        Alert::info('Showing %s published in %s.', ['posts', '<em>' . $archive->i((false === strpos($name, '-') ? "" : '%B ') . '%Y') . '</em>']);
    });
    Hook::set('route.search', function($content, $path, $query, $hash, $data) {
        Alert::info('Showing %s matched with query %s.', ['posts', '<em>' . $data['query'] . '</em>']);
    });
    Hook::set('route.tag', function($content, $path, $query, $hash, $data) {
        if (is_file($file = LOT . D . 'tag' . D . $data['name'] . '.page')) {
            $tag = new Tag($file);
            Alert::info('Showing %s tagged in %s.', ['posts', '<em>' . $tag->title . '</em>']);
        }
    });
    Hook::set('y.alert', function($alert) {
        foreach ($alert[1] as &$v) {
            $v[2]['aria-live'] = ['error' => 'assertive', 'info' => 'off', 'success' => 'polite'][$v[2]['type'] ?? $v['type']] ?? null;
        }
        unset($v);
        return $alert;
    });
}

if (isset($state->x->excerpt) && $state->is('page')) {
    Hook::set('page.content', function($content) {
        return strtr($content, ["\f" => '<hr id="next:' . $this->id . '" role="doc-pagebreak">']);
    });
}