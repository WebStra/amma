<?php

use App\Category;
use App\CategoryFilter;

return [
    'title' => 'Category Filters',

    'description' => 'Filters for categories.',

    'model' => \App\CategoryFilter::class,

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

        'filtreable_name' => [
            'title' => 'Category name',
            'output' => function ($row) {
                return ($row->filterable) ? $row->filterable->name : '';
            }
        ],

        'filter_type' => [
            'title' => 'Type of filter',
        ],

        'group',

        'filter_attributes',

        'active' => [
            'visible' => function () {
            },
            'output' => function ($row) {
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
        return $query->where('filterable_type', Category::class);
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

        'group' => filter_select('Group', function(){
            $items = ['' => '-- Any --'];

            $groups = CategoryFilter::select('group')
                ->where('filterable_type', Category::class)
                ->pluck('group')
                ->toArray();

            if(count($groups))
            {
                $groups = array_flip($groups);

                array_walk($groups, function($id, $group) use(&$items){
                    $items[$group] = ucfirst($group);
                });
            }

            return $items;
        }),

        'filter_type' => filter_select('Filter type', function () {
            return [
                '' => '-- Any --',
                'checkbox' => '-- Checkbox --',
                'select' => '-- Select --'
            ];
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
        'name' => form_text() + translatable(),

        'filterable_type' => [
            'type' => 'hidden',
            'value' => Category::class
        ],

        'filterable_id' => form_select('Choose category', function () {
            $items = [];

            $categories = Category::select('*')->active()->get();

            foreach ($categories as $item) {
                $items[$item->id] = $item->name;
            }

            return $items;
        }),

        'active' => form_boolean()
    ]
];