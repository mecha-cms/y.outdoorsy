<?php

if ('POST' === $_SERVER['REQUEST_METHOD'] && empty($_POST['state']['y']['outdoorsy']['page']['header'])) {
    // Set default value to `false`
    $_POST['state']['y']['outdoorsy']['page']['header'] = false;
}

Hook::set('_', function($_) use($state, $url) {
    if ('.state' === $_['path']) {
        $time = new Time;
        $formats = [];
        foreach ([
            '%A, %B %d, %Y',
            '%A, %d %B %Y',
            '%F %T',
            '%Y/%m/%d %I:%M %p',
            '%Y/%m/%d %T',
            '%c',
            '%x',
        ] as $format) {
            $formats[$format] = $time($format);
        }
        $lot = [];
        foreach (Pages::from(LOT . D . 'page', 'archive,page')->sort([1, 'title']) as $v) {
            $lot[strtr($v->url, [
                $url . '/' => '/'
            ])] = $v->title;
        }
        $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['blog']['lot']['fields'] = [
            'lot' => [],
            'type' => 'fields'
        ];
        $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['blog']['lot']['fields']['lot']['time-format'] = [
            'block' => true,
            'lot' => $formats,
            'name' => 'state[y][outdoorsy][page][timeFormat]',
            'stack' => 110,
            'title' => 'Date/Time',
            'type' => 'item',
            'value' => $state->y->outdoorsy->page->timeFormat ?? '%F %T'
        ];
        $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['blog']['lot']['fields']['lot']['options'] = [
            'lot' => [
                'header' => 'Show page header on pages layout.'
            ],
            'name' => 'state[y][outdoorsy][page]',
            'stack' => 120,
            'title' => 'Options',
            'type' => 'items',
            'values' => [
                'header' => !empty($state->y->outdoorsy->page->header) ? true : null
            ]
        ];
        $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['blog']['lot']['fields']['lot']['route-blog'] = [
            'description' => 'Choose default page for the blog route.',
            'lot' => $lot,
            'name' => 'state[route-blog]',
            'stack' => 130,
            'title' => 'Route',
            'type' => 'option',
            'value' => $state->routeBlog
        ];
    }
    return $_;
}, 0);