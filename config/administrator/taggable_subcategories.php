<?php

use App\Product;
use App\Repositories\ProductsRepository;
use App\Tag;
use App\Taggable;

return [
    'title' => 'Tag subcategories',

    'description' => 'Attach subcategories for tags',

    'model' => \App\TaggableSubCategory::class,

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

        'taggable_tag_id' => [
            'title' => 'Tag',
            'output' => function($row){
                if($row->tag)
                    return $row->tag->name;

                return 'N\a';
            }
        ],

        'sub_category_id' => [
            'title' => 'Sub category',
            'output' => function($row){
                if($row->subCategory)
                    return $row->subCategory->present()->renderName();

                return 'N\a';
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

        'taggable_tag_id' => filter_select('Tag', function () {
            $items = ['' => '-- Any --'];

            $collection = Tag::select('*')->active()->get();

            foreach ($collection as $item)
            {
                $items[$item->id] = $item->name;
            }

            return $items;
        }),

        'sub_category_id' => filter_select('Sub category', function () {
            $items = ['' => '-- Any --'];

            $collection = \App\SubCategory::select('*')->active()->get();

            foreach ($collection as $item)
            {
                $items[$item->id] = $item->name;
            }

            return $items;
        }),
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

        'taggable_tag_id' => [
            'type' => 'select',
            'label' => 'Choose Tag',
            'options' => function()
            {
                return (new \App\Repositories\TagRepository())->lists('name', 'id', true);
            }
        ],

        'sub_category_id' => [
            'type' => 'select',
            'label' => 'Choose sub category',
            'options' => function()
            {
                return (new \App\Repositories\SubCategoriesRepository())->lists('name', 'id', true);
            }
        ]
    ]
];