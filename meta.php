<?php

$metas = [];

if (isset($state->x->feed)) {
    $metas[$url . ($state->routeBlog ?? '/article') . '/feed.xml'] = 'RSS';
}

if (isset($state->x->sitemap)) {
    $metas[$url . '/sitemap.xml'] = 'Sitemap';
}

if (isset($state->x->user)) {
    $route = $state->x->user->route ?? '/user';
    if (Is::user()) {
        $metas[$url . $route . '/' . $user->name . $url->query([
            'exit' => $user->token,
            'kick' => $url->path
        ])] = 'Exit';
    } else {
        $metas[$url . $route . $url->query([
            'kick' => $url->path
        ])] = 'Enter';
    }
}

// Make sure that list is not empty so that the copyright line will not shift up coverring the hard-drawn horizontal rule
!$metas && ($metas[$url . ""] = 'Home');

if ($metas) {
    asort($metas);
    echo '<ul>';
    foreach ($metas as $k => $v) {
        echo '<li>';
        echo '<a href="' . From::HTML($k) . '">' . i($v) . '</a>';
        echo '</li>';
    }
    echo '</ul>';
}