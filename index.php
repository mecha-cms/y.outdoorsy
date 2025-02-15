<?php namespace y\outdoorsy;

function links(string $folder) {
    \extract(\lot(), \EXTR_SKIP);
    $r = [];
    $route_current = $url->path . '/';
    $route_index = '/' . \trim($state->route ?? 'index', '/');
    foreach (\g($folder, 'page') as $k => $v) {
        $v = new \Page($k);
        // Exclude home page
        if ($route_index === ($route = $v->route)) {
            continue;
        }
        // Add current state
        $v->current = 0 === \strpos($route_current, $route . '/');
        $r[$v->title . \P . $k] = $v;
    }
    \ksort($r);
    return \array_values($r);
}

\lot('links', new \Anemone(links(\LOT . \D . 'page')));

function page__content($content) {
    if (null === $content) {
        return $content;
    }
    \extract(\lot(), \EXTR_SKIP);
    if (!$state->is('page')) {
        return $content;
    }
    return \strtr($content, ["\f" => '<hr id="next:' . $this->id . '" role="doc-pagebreak">']);
}

function route__archive($content, $path, $query) {
    \extract(\lot(), \EXTR_SKIP);
    if ($state->is('error')) {
        return;
    }
    if (!$name = (\From::query($query)['name'] ?? 0)) {
        return;
    }
    $archive = new \Time(\substr_replace('1970-01-01-00-00-00', $name, 0, \strlen($name)));
    $format = (false === \strpos($name, '-') ? "" : '%B ') . '%Y';
    if ($search = ($state->{'[x]'}->search->query ?? 0)) {
        \Alert::info('Showing %s published in %s and matched with query %s.', ['posts', '<b>' . $archive->i($format) . '</b>', '<b>' . $search . '</b>']);
    } else {
        \Alert::info('Showing %s published in %s.', ['posts', '<b>' . $archive->i($format) . '</b>']);
    }
}

function route__search() {
    \extract(\lot());
    if ($state->is('error')) {
        return;
    }
    if (!$search = ($state->{'[x]'}->search->query ?? 0)) {
        return;
    }
    if (!$state->is('archives') && !$state->is('tags')) {
        \Alert::info('Showing %s matched with query %s.', ['posts', '<b>' . $search . '</b>']);
    }
}

function route__tag() {
    \extract(\lot());
    if ($state->is('error')) {
        return;
    }
    if (!isset($tag)) {
        return;
    }
    if ($search = ($state->{'[x]'}->search->query ?? 0)) {
        \Alert::info('Showing %s tagged in %s and matched with query %s.', ['posts', '<b>' . $tag->title . '</b>', '<b>' . $search . '</b>']);
    } else {
        \Alert::info('Showing %s tagged in %s.', ['posts', '<b>' . $tag->title . '</b>']);
    }
}

function y__alert($y) {
    foreach ($y[1] as &$v) {
        $v[2]['aria-live'] = ['error' => 'assertive', 'info' => 'off', 'success' => 'polite'][$v[2]['type'] ?? $v['type']] ?? null;
    }
    unset($v);
    return $y;
}

if (isset($state->x->alert)) {
    \Hook::set('route.archive', __NAMESPACE__ . "\\route__archive", 100.1);
    \Hook::set('route.search', __NAMESPACE__ . "\\route__search", 100.1);
    \Hook::set('route.tag', __NAMESPACE__ . "\\route__tag", 100.1);
    \Hook::set('y.alert', __NAMESPACE__ . "\\y__alert");
}

if (isset($state->x->excerpt)) {
    \Hook::set('page.content', __NAMESPACE__ . "\\page__content");
}

if (isset($state->x->search)) {
    \State::set('[x].search.query', \trim(\strip_tags($_GET[$state->x->search->key ?? 'query'] ?? "")));
}

\Asset::set(__DIR__ . D . 'index' . (\defined("\\TEST") && \TEST ? '.' : '.min.') . 'css', 20);

$states = [
    'route-blog' => '/article',
    'x.comment.page.type' => isset($state->x->comment) ? 'Markdown' : null,
    'x.page.page.type' => isset($state->x->page) ? 'Markdown' : null
];

foreach ($states as $k => $v) {
    !\State::get($k) && null !== $v && \State::set($k, $v);
}

if (!empty($state->y->outdoorsy->page->header)) {
    \State::set('with.page-header', true);
}