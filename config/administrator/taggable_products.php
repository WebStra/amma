<?php

use App\Product;
use App\Repositories\ProductsRepository;
use App\Taggable;

return [
    'title' => 'Product tags',

    'description' => 'Product tags',

    'model' => Taggable::class,

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

        'tag_id' => [
            'output' => function($row){
                if($row->tag)
                    return $row->tag->name;

                return 'no tag';

            }
        ],
        'taggable_id' => [
            'output' => function($row){
                if($row->taggable)
                    return $row->taggable->name;

                return 'no taggable';
            }
        ],

        'dates' => [
            'elements' => [
                'created_at',
                'updated_at'
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
        return $query->elementType(Product::class);
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
        //
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

        'taggable_type' => [
            'type' => 'hidden',
            'value' => Product::class
        ],

        'taggable_id' => [
            'type' => 'select',
            'label' => 'Choose partner',
            'options' => function()
            {
                return (new ProductsRepository())->lists('name', 'id', true);
            }
        ],

//        'tag_id' => [
//            'type' => 'select',
//            'label' => 'Choose partner',
//            'options' => function()
//            {
//                return (new CategoryRepository())->lists('name', 'id', true);
//            }
//        ],
    ]
];