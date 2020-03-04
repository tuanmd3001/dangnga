<?php

return [
    'default' => 'dangnga',

    'themes' => [
        'default' => [
            'views_path' => 'resources/themes/default/views',
            'assets_path' => 'public/themes/default/assets',
            'name' => 'Default'
        ],
        'dangnga' => [
            'views_path' => 'resources/themes/dangnga/views',
            'assets_path' => 'public/themes/dangnga/assets',
            'name' => 'Dangnga',
            'parent' => 'default'
        ],

        // 'bliss' => [
        //     'views_path' => 'resources/themes/bliss/views',
        //     'assets_path' => 'public/themes/bliss/assets',
        //     'name' => 'Bliss',
        //     'parent' => 'default'
        // ]

        'velocity' => [
            'views_path' => 'resources/themes/velocity/views',
            'assets_path' => 'public/themes/velocity/assets',
            'name' => 'Velocity',
            'parent' => 'default'
        ],
    ]
];