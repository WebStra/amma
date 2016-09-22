<?php

use App\Tag;

return [
    'title' => 'Tags',

    'description' => 'General Tags',

    'model' => Tag::class,

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
        'tag_id',

        'category_id' => [
            'output' => function($row){
                if($row->category)
                    return $row->category->name;

                return 'no category';
            }
        ],

        'name',

        'normalized',

        'active' => [
            'visible' => function () {
            },
            'output' => function ($row) {
                return output_boolean($row);
            }
        ],

        'dates' => [
            'elements' => [
                'created_at' => [
                    'output' => function($row){
                        return $row->created_at->format('d M Y');
                    }
                ],
                'updated_at' => [
                    'output' => function($row){
                        return $row->updated_at->format('d M Y');
                    }
                ]
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
        //
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
        'tag_id' => filter_hidden(),

        'category_id' => filter_select('Category', function(){
            $items = [ '' => '-- Any --' ];

            $categories = Category::select('*')->active()->get();

            foreach ($categories as $item) {
                $items[$item->id] = $item->name;
            }

            return $items;
        }),

        'active' => filter_select('Active', [
            '' => '-- Any --',
            1 => 'Active',
            0 => 'None active'
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

        'name' => form_text('Tag name') + translatable(),

        'category_id' => form_select('Category', function (){
            $items = [];

            $categories = Category::select('*')->active()->get();

            foreach ($categories as $item) {
                $items[$item->id] = $item->name;
            }

            return $items;
        }),

        //'normalized' => form_text(),

        'active' => form_boolean()
    ]
];