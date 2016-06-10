<?php

use App\Category;
use App\Libraries\Categoryable\Categoryable;

return [
    'title' => 'SubCategories',

    'description' => 'Here you can create subcategories for <a href="/admin/categories">categories</a>.',

    'model' => Category::class,

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

        'belongs' => [
            'title' => 'Belongs to (parent)',
            'output' => function ($row) {
                $categoryable = Categoryable::select("*")
                    ->where('categoryable_id', $row->id)
                    ->categories()
                    ->first();

                if (!is_null($categoryable))
                    return $categoryable->category->name;

                return 'no parent';
            }
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
        return $query->child();
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

        'parent' => filter_select('Parent', function () {
            return Category::select("*")
                ->parent()
                ->active()
                ->translated()
                ->get()
                ->pluck('name', 'id')
                ->prepend('-- Any --', '');
        }, function ($query, $value) {
            $parent = Category::whereId($value)->first();

            $childrens = [];
            $parent->categoryables->each(function ($child) use (&$childrens){
                $childrens[] = $child->categoryable->id;
            });

            return $query->whereIn('id', $childrens);
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

        'name' => form_text() + translatable(),

        'type' => [
            'type' => 'hidden',
            'value' => 'child'
        ],

//        'slug' => form_text() + translatable(),

//        'rank' => form_text(),

        'show_in_footer' => form_select('Show in footer', [
            0 => '-- No --',
            1 => '-- Yes --'
        ]),

        'show_in_sidebar' => [
            'type' => 'hidden',
            'value' => '0'
        ],

        'active' => form_select('Active', [
            1 => '-- Yes --',
            0 => '-- No --'
        ]),
    ]
];