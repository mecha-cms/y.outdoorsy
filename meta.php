<?php

$metas = [];

if (isset($state->x->feed)) {
    $metas[$link->base(($state->routeLog ?? '/article') . '/feed.xml')] = 'RSS';
}

if (isset($state->x->sitemap)) {
    $metas[$link->base('/sitemap.xml')] = 'Sitemap';
}

if (isset($state->x->user, $user)) {
    $route = $state->x->user->route ?? '/user';
    $route_secret = $state->x->user->guard->route ?? $route;
    if ($user->exist) {
        $metas[$link->base($route_secret . '/' . $user->name, [
            'exit' => $user->token,
            'kick' => $link->path
        ])] = 'Exit';
    } else {
        $metas[$link->base($route_secret, [
            'kick' => $link->path
        ])] = 'Enter';
    }
}

// Make sure that list is not empty so that the copyright line will not shift up coverring the hard-drawn horizontal rule
!$metas && ($metas[$link->home] = 'Home');

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