<?php

use App\Partner;

return [
    'title' => 'Partners',

    'description' => 'Partners list',

    'model' => Partner::class,

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

        'image' => [
            'title' => 'Logo',
            'output' => function($row)
            {
                $image = $row->images()->cover()->first();

                return $image ? output_image($image->image) : '';
            }
        ],

        'link' => [
            'title' => 'Link',
            'output' => function ($row){
                return sprintf('<a href="%s">%s</a>', $row->link, $row->link);
            }
        ],

        'show_in_footer' => [
            'visible' => function() {},
            'output' => function($row) {
                return output_boolean($row);
            }
        ],

        'active' => [
            'visible' => function() {},
            'output' => function($row) {
                return output_boolean($row);
            }
        ],

        'rank'
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

        'show_in_footer' => [
            'label' => 'Show only in footer',
            'type' => 'select',
            'options' => [
                '' => '-- Any --',
                1 => '-- Yes --',
                0 => '-- No --'
            ]
        ],

        'active' => [
            'label' => 'Active',
            'type' => 'select',
            'options' => [
                '' => '-- Any --',
                1 => '-- Active --',
                0 => '-- None Active --'
            ]
        ]
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

        'name' => form_text(),

        'link' => form_text(),

        'show_in_footer' => form_select('Show in footer', [
            '1' => '-- Yes --',
            '0' => '-- No --'
        ]),

        'rank' => form_text(),

        'active' => form_boolean()
    ]
];