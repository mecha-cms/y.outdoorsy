<?php

$lot = [];

foreach (Pages::from(LOT . D . 'page', 'archive,page')->sort([1, 'title']) as $v) {
    $lot[strtr($v->url, [
        $url . '/' => '/'
    ])] = $v->title;
}

if ('.state' === $_['path']) {
    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['path-blog'] = [
        'title' => 'Blog',
        'type' => 'option',
        'name' => 'state[route-blog]',
        'description' => 'Choose default page for the blog path.',
        'lot' => $lot,
        'value' => $state->routeBlog,
        'stack' => 100
    ];
}