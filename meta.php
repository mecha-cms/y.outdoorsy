<?php

$metas = [];

if (isset($state->x->feed)) {
    $metas[$url . ($state->pathBlog ?? '/article') . '/feed.xml'] = 'RSS';
}

if (isset($state->x->sitemap)) {
    $metas[$url . '/sitemap.xml'] = 'Sitemap';
}

if (isset($state->x->user)) {
    $x_user_path = $state->x->user->path ?? '/user';
    if (Is::user()) {
        $metas[$url . $x_user_path . '/' . $user->name . $url->query('&', [
            'exit' => $user->token,
            'kick' => $url->path
        ])] = 'Exit';
    } else {
        $metas[$url . $x_user_path . $url->query('&', [
            'kick' => $url->path
        ])] = 'Enter';
    }
}

asort($metas);

if ($metas) {
    echo '<ul>';
    foreach ($metas as $k => $v) {
        echo '<li>';
        echo '<a href="' . From::HTML($k) . '">' . i($v) . '</a>';
        echo '</li>';
    }
    echo '</ul>';
}