<?php

$metas = [];

if (isset($state->x->feed)) {
    $metas[$url . ($state->routeBlog ?? '/article') . '/feed.xml'] = 'RSS';
}

if (isset($state->x->sitemap)) {
    $metas[$url . '/sitemap.xml'] = 'Sitemap';
}

if (isset($state->x->user, $user)) {
    $route = $state->x->user->route ?? '/user';
    $route_secret = $state->x->user->guard->route ?? $route;
    if ($user->exist) {
        $metas[$url . $route_secret . '/' . $user->name . $url->query([
            'exit' => $user->token,
            'kick' => $url->path
        ])] = 'Exit';
    } else {
        $metas[$url . $route_secret . $url->query([
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
        echo '<a href="' . eat($k) . '">' . i($v) . '</a>';
        echo '</li>';
    }
    echo '</ul>';
}