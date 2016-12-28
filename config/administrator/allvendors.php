<?php

use App\Vendor;

return [
    'title' => 'Vendors',

    'description' => 'Every user can create the vendor and add for it multiple products.',

    'model' => Vendor::class,

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

        'image' => [
            'title' => 'Cover',
            'output' => function($row)
            {
                $image = $row->images()->cover()->first();

                return $image ? output_image($image->image, null, ['width' => '100']) : '';

            }
        ],

        'user_id' => [
            'title' => 'User',
            'output' => function ($row){
                return $row->user->email;
            }
        ],
        
        'name',

        'email',
        
        'phone',
        
        'description',

        'active' => [
            'visible' => function() {},
            'output' => function($row) {
                return output_boolean($row);
            }
        ],

//        'dates' => [
//            'elements' => [
//                'created_at',
//                'updated_at'
//            ]
//        ]
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

        'active' => filter_select('Active', [
            '' => '-- Any --',
            '1' => '-- Active --',
            '0' => '-- None Active --',
        ]),

        'created_at' => filter_daterange('Created period')
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

        'image' => [
            'type' => 'image',
            'location' => '/upload/vendors/(:id)',
        ],

        'name' => form_text(),

        'phone' => form_text(),

        'description' => form_wysi_html5(),

        'active' => form_boolean()
    ]
];