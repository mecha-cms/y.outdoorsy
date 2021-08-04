<?php

$z = defined('DEBUG') && DEBUG ? '.' : '.min.';
Asset::set(__DIR__ . DS . 'asset' . DS . 'css' . DS . 'index' . $z . 'css', 20);

$GLOBALS['links'] = new Anemon((function($links, $state, $url) {
    $index = LOT . DS . 'page' . strtr($state->path, '/', DS) . '.page';
    $path = $url->path . '/';
    foreach (g(LOT . DS . 'page', 'page') as $k => $v) {
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

$defaults = ['path-blog' => '/article'];

foreach ($defaults as $k => $v) {
    !State::get($k) && State::set($k, $v);
}

// Info message(s)
Hook::set('layout', function() {
    extract($GLOBALS);
    if (!$site->is('error')) {
        if ($site->is('archives')) {
            $chops = explode('/', $url->path);
            $v = explode('-', array_pop($chops));
            $v = $archive->i((1 === count($v) ? "" : '%B ') . '%Y');
            Alert::info('Showing %s published in %s.', ['posts', '<em>' . $v . '</em>']);
        }
        if ($site->is('search') && $v = Get::get($state->x->search->key ?? 'q')) {
            Alert::info('Showing %s matched with query %s.', ['posts', '<em>' . $v . '</em>']);
        }
        if ($site->is('tags')) {
            Alert::info('Showing %s tagged in %s.', ['posts', '<em>' . $tag->title . '</em>']);
        }
    }
});
