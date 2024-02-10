<?php

echo self::widget([
    'content' => isset($state->x->search) ? '<search>' . self::form('search', [
        'route' => $route ?? $state->routeBlog ?? '/article',
    ]) . '</search>' : '<p role="status">' . i('Missing %s extension.', ['<a href="https://mecha-cms.com/store/extension/search" target="_blank">search</a>']) . '</p>',
    'title' => $title ?? i('Search')
]);