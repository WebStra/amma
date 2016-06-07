<?php

return [
    'title' => 'Products',

    'description' => 'Users products',

    'model' => 'App\Product',

    /*
    |-------------------------------------------------------
    | Columns/Groups
    |-------------------------------------------------------
    |
    | Describe here full list of columns that should be presented
    | on main listing page
    |
    */
    'columns' => [
        'id',

        'name',

        'price_info' => [
            'title' => 'Price Information',
            'elements' => [
                'price' => [
                    'title' => 'Current Price',
                    'output' => function ($row) {
                        return sprintf('%s MDL', ceil($row->price));
                    }
                ],
                'sale' => [
                    'title' => 'Sale',
                    'output' => function ($row) {
                        return sprintf("%s %%", $row->sale);
                    }
                ],
                'new_price' => [
                    'title' => 'Price with sale',
                    'output' => function ($row) {
                        return sprintf('%s MDL', ( // calc percent.
                            ceil($row->price - ($row->price * ($row->sale / 100))))
                        );
                    }
                ],
                'count' => [
                    'title' => 'Remains',
                    'output' => function ($row) {
                        return sprintf('%s штук.', $row->count);
                    }
                ]
            ]
        ],

        'tags' => [
            'elements' => [
                'type',
                'status' => [
                    'output' => function ($row){
                        switch ($row->status) {
                            case 'published':
                                $status = '<b style="color: #0c84bf;">Publish</b>';
                                break;
                            case 'drafted':
                                $status = '<b style="color: #d07e3a">Drafted</b>';
                                break;
                            case 'completed':
                                $status = '<b style="color: #00a65a">Completed</b>';
                                break;
                        }

                        return $status;
                    }
                ]
            ]
        ],

        'dates' => [
            'elements' => [
                'published_date',
                'expiration_date',
                'created_at',
                'updated_at',
            ]
        ]
    ],

    /*
    |-------------------------------------------------------
    | Actions available to do, including global
    |-------------------------------------------------------
    |
    | Global actions
    |
    */
    'actions' => [

    ],

    /*
    |-------------------------------------------------------
    | Eloquent With Section
    |-------------------------------------------------------
    |
    | Eloquent lazy data loading, just list relations that should be preloaded
    |
    */
    'with' => [

    ],

    /*
    |-------------------------------------------------------
    | QueryBuilder
    |-------------------------------------------------------
    |
    | Extend the main scaffold index query
    |
    */
    'query' => function ($query) {
        return $query;
    },

    /*
    |-------------------------------------------------------
    | Global filter
    |-------------------------------------------------------
    |
    | Filters should be defined here
    |
    */
    'filters' => [
        'name' => filter_text(),

        'price' => filter_number_range('Price Range', [
            'min' => '100',
            'max' => '10000'
        ]),

        'type' => filter_select('Type', [
            '' => '-- Any --',
            'old_product' => '-- Old --',
            'new' => '-- New --',
        ], function ($query, $value){
            // This stuff is hardcoded, it used because keyword 'old' is reserved.
            if ($value == 'old_product')
                return $query->whereType('old');
        }),

        'status' => filter_select('Active', [
            '' => '-- Any --',
            'published' => '-- Published --',
            'drafted' => '-- Drafted --',
            'completed' => '-- Completed --'
        ]),

        'created_at' => filter_daterange('Created period'),
        'published_date' => filter_daterange('Published date'),
        'expiration_date' => filter_daterange('Expiration date')
    ],

    /*
    |-------------------------------------------------------
    | Editable area
    |-------------------------------------------------------
    |
    | Describe here all fields that should be editable
    |
    */
    'edit_fields' => [

        'id' => form_key(),

        'name' => form_ckeditor(),

        'active' => filter_select('Active', [
            0 => 'No',
            1 => 'Yes'
        ]),
    ]
];