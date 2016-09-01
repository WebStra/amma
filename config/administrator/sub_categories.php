<?php

use App\Category;

return [
    'title' => 'SubCategories',

    'description' => 'Here you can create subcategories for <a href="/admin/categories">categories</a>.',

    'model' => \App\SubCategory::class,

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

        'name',

        'category_id' => [
            'title' => 'Parent Category',
            'output' => function ($row) {
                return ($row->category) ? $row->category->name: '';
            }
        ],

        'info' => [
            'title'     => 'Seo info',
            'elements'  => [
                'seo_title' => [
                    'title' => '(Seo) Title'
                ],
                'seo_description' => [
                    'title' => '(Seo) Description'
                ],
                'seo_keywords' => [
                    'title' => '(Seo) Keywords'
                ],
            ]
        ],

        'active' => [
            'visible' => function () {
            },
            'output' => function ($row) {
                return output_boolean($row);
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

        'name' => filter_text('Name', function ($query, $value) {
            return $query->select('*')
                ->where('name', 'like', '%' . $value . '%')
                ->translated();
        }),

        'category_id' => filter_select('Parent', function () {
            $items = ['' => '-- Any --'];

            $collection = Category::select('*')->active()->get();

            foreach ($collection as $item)
            {
                $items[$item->id] = $item->name;
            }

            return $items;
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

        'image' => [
            'type' => 'image',
            'location' => 'upload/categories'
        ],

        'category_id' => filter_select('Choose parent category', function () {
            $items = [];

            $collection = Category::select('*')->active()->get();

            foreach ($collection as $item)
            {
                $items[$item->id] = $item->name;
            }

            return $items;
        }),

        'name' => form_text() + translatable(),

        'slug' => [
            'type' => 'text',
            'description' => '(Optional)',
            'translatable' => true
        ],

        'seo_title' => form_text() + translatable(),

        'seo_description' => form_text() + translatable(),

        'seo_keywords' => form_text() + translatable(),

        'active' => form_boolean()
    ]
];