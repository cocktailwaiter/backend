<?php

return [
    'response' => [
        'paginate_wrapper'      => 'paginate',
        'paginates'             => [
                                    'total',
                                    'per_page',
                                    'current_page',
                                    'last_page',
                                    'from',
                                    'to',
        ],
        // responseOk
        'data_wrapper'               => 'data',
        // responseFailure
        'failure' => [
            'wrapper'           => 'error',
            'fields'            => 'code',
        ],
    ],
    'pager' => [
        'limit' => [
            'default'           => 50,
            'max'               => 100,
            'min'               => 1,
            'all'               => 0,
        ],
        'page' => [
            'default'           => 1,
            'max'               => 100,
            'min'               => 1,
        ],
    ],
    'cocktail' => [
        'response' => [
            'fields' => [
                            'id',
                            'name',
                            'tags',
                            'updated_at',
            ],
            'field' => [
                'tag' => [
                            'id',
                            'name',
                            'good',
                            'bad',
                            'tag_category',
                ],
                'tag_category' => [
                            'id',
                            'name',
                ]
            ]
        ]
    ],
    'tag' => [
        'response' => [
            'fields' => [
                            'id',
                            'name',
                            'category',
                            'updated_at',
            ],
            'field' => [
                'category' => [
                            'id',
                            'name',
                ]
            ]
        ]
    ]
];
