<?php

use App\Category;
use App\Libraries\Categoryable\Categoryable;

return [
    'title' => 'Relations',

    'description' => 'Here you can organize hierarchy structure of categories and subcategories.',

    'model' => Categoryable::class,

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

        'belongs' => [
            'title' => 'Belongs to',
            'output' => function($row) {
                return '<a href="#">' . $row->category->name .'</a>';
            }
        ],

        'attached' => [
            'title' => 'Child category',
            'output' => function ($row) {
                return $row->categoryable->name;
            }
        ],

        'active' => [
            'visible' => function() {},
            'output' => function($row) {
                return output_boolean($row);
            }
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
        return $query->categories();
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

        'category_id' => filter_select('Belongs to', function () {
            return Category::select('*')
                ->parent()
                ->get()
                ->pluck('name', 'id')
                ->prepend('-- Any --', '');
        }),

        'active' => filter_select('Active', [
            '' => '-- Any --',
            '1' => '-- Active --',
            '0' => '-- None Active --',
        ]),
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

        'categoryable_type' => [
            'type' => 'hidden',
            'value' => Category::class
        ],

        'category_id' => [
            'label' => 'Choose parent category',
            'type' => 'select',
            'options' => function () {
                return Category::select('*')
                    ->parent()
                    ->get()
                    ->pluck('name', 'id');
            },
            'attributes' => [
                'value' => function () {
                    return 2;
                }
            ]
        ],

        'categoryable_id' => [
            'label' => 'Choose child category',
            'type' => 'select',
            'options' => function () {
                return Category::select('*')
                    ->child()
                    ->get()
                    ->pluck('name', 'id');
            }
        ],

        'active' => form_select('Active', [
            1 => '-- Yes --',
            0 => '-- No --'
        ]),
    ]
];