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

        'status' => [
            'output' => function ($row){
                switch ($row->status) {
                    case 'published':
                        $status = '<b style="color: #605ca8;">Publish</b>';
                        break;
                    case 'drafted':
                        $status = '<b style="color: #d04b3f">Drafted</b>';
                        break;
                    case 'completed':
                        $status = '<b style="color: #00a65a">Completed</b>';
                        break;
                }

                return $status;
            }
        ],

        'type',

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
        'id' => filter_hidden(),

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
            // This stuff is hardcoded, it was used because keyword 'old' is reserved.
            if ($value == 'old_product')
                return $query->whereType('old');
        }),

        'status' => filter_select('Status', [
            '' => '-- Any --',
            'published' => '-- Published --',
            'drafted' => '-- Drafted --',
            'completed' => '-- Completed --'
        ]),

        'active' => filter_select('Active', [
            '' => '-- Any --',
            '1' => '-- Active --',
            '0' => '-- None Active --',
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

        'active' => form_boolean()
    ]
];