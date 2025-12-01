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

function route__archive() {
    \extract(\lot());
    if (!$state->has('part') || $state->is('error') || !isset($archive)) {
        return;
    }
    $f = (false === \strpos($state->q('archive.name') ?? "", '-') ? "" : '%B ') . '%Y';
    if ($q = $state->q('search.query')) {
        \Alert::info('Showing %s of %s published in %s and matched with query %s.', ['posts', '<b>' . $page->title . '</b>', '<b>' . $archive->i($f) . '</b>', '&#x201c;' . $q . '&#x201d;']);
    } else {
        \Alert::info('Showing %s of %s published in %s.', ['posts', '<b>' . $page->title . '</b>', '<b>' . $archive->i($f) . '</b>']);
    }
}

function route__author() {
    \extract(\lot());
    if (!$state->has('part') || $state->is('error') || !isset($author)) {
        return;
    }
    if ($q = $state->q('search.query')) {
        \Alert::info('Showing all %s written by %s and matched with query %s.', ['posts', '<b>' . $author->title . '</b>', '&#x201c;' . $q . '&#x201d;']);
    } else {
        if ($q = $state->q('author.name')) {
            if ($page instanceof \Author) {
                \Alert::info('Showing all %s written by %s.', ['posts', '<b>' . $page->title . '</b>']);
            } else {
                \Alert::info('Showing all %s of %s written by %s.', ['posts', '<b>' . $page->title . '</b>', '<b>' . $author->title . '</b>']);
            }
        } else {
            if ($page->path) {
                \Alert::info('Showing all %s of %s.', ['authors', '<b>' . $page->title . '</b>']);
            } else {
                \Alert::info('Showing all %s.', ['authors']);
            }
        }
    }
}

function route__search() {
    \extract(\lot());
    if (!$state->has('part') || $state->is('error') || !($q = $state->q('search.query'))) {
        return;
    }
    if (!$state->is('archives') && !$state->is('authors') && !$state->is('tags')) {
        \Alert::info('Showing %s matched with query %s.', ['posts', '&#x201c;' . $q . '&#x201d;']);
    }
}

function route__tag() {
    \extract(\lot());
    if (!$state->has('part') || $state->is('error') || !isset($tag)) {
        return;
    }
    if ($q = $state->q('search.query')) {
        \Alert::info('Showing all %s tagged in %s and matched with query %s.', ['posts', '<b>' . $tag->title . '</b>', '&#x201c;' . $q . '&#x201d;']);
    } else {
        if ($q = $state->q('tag.name')) {
            if ($page instanceof \Tag) {
                \Alert::info('Showing all %s tagged in %s.', ['posts', '<b>' . $page->title . '</b>']);
            } else {
                \Alert::info('Showing all %s of %s tagged in %s.', ['posts', '<b>' . $page->title . '</b>', '<b>' . $tag->title . '</b>']);
            }
        } else {
            if ($page->path) {
                \Alert::info('Showing all %s of %s.', ['tags', '<b>' . $page->title . '</b>']);
            } else {
                \Alert::info('Showing all %s.', ['tags']);
            }
        }
    }
}

function y__alert($y) {
    foreach ($y[1] as &$v) {
        $v[2]['aria-live'] = ['error' => 'assertive', 'info' => 'off', 'success' => 'polite'][$v[2]['type'] ?? $v['type']] ?? null;
    }
    unset($v);
    return $y;
}

\Asset::set(__DIR__ . D . 'index' . (\defined("\\TEST") && \TEST ? '.' : '.min.') . 'css', 20);

if (isset($state->x->alert)) {
    \Hook::set('route.archive', __NAMESPACE__ . "\\route__archive", 100.1);
    \Hook::set('route.author', __NAMESPACE__ . "\\route__author", 100.1);
    \Hook::set('route.search', __NAMESPACE__ . "\\route__search", 100.1);
    \Hook::set('route.tag', __NAMESPACE__ . "\\route__tag", 100.1);
    \Hook::set('y.alert', __NAMESPACE__ . "\\y__alert");
}

if (isset($state->x->excerpt)) {
    \Hook::set('page.content', __NAMESPACE__ . "\\page__content");
}

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