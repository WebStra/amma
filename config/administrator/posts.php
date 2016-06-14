<?php

use App\Post;

return [
    'title' => 'Posts',

    'description' => 'Amma\'s blog posts',

    'model' => Post::class,

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

        'title',

        'status' => [
            'title' => 'Status',
            'output' => function($row) {
                switch ($row->status) {
                    case 'published':
                        $status = '<b style="color: #605ca8;">Published</b>';
                        break;
                    case 'drafted':
                        $status = '<b style="color: #d04b3f">Drafted</b>';
                        break;
                }

                return $status;
            }
        ],

        'body' => [
            'title' => 'Post content',
            'output' => function ($row){
                return sprintf('%s ...', substr($row->body, 0, 175));
            }
        ],

        'active' => [
            'visible' => function() {},
            'output' => function($row) {
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

        'title' => filter_text('Title', function ($query, $value) {
            return $query->select('*')
                ->where('name', 'like', '%'.$value.'%')
                ->translated();
        }),

        'status' => filter_select('Status', [
            '' => '-- Any --',
            'published' => '-- Published --',
            'drafted' => '-- Drafted --',
        ]),

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

        'title' => [
            'type' => 'text',
            'translatable' => true,
            'description' => '<span style="color: red">Pls fill all title inputs for all languages.</span>'
        ],

        'body' => form_wysi_html5() + translatable(),

        'status' => [
            'type' => 'select',
            'options' => [
                'published' => 'Publish',
                'drafted' => 'Keep draft'
            ]
        ],

        'seo_title' => form_text('Seo Title') + translatable(),

        'seo_description' => form_wysi_html5() + translatable(),

        'seo_keywords' => form_text() + translatable(),

        'active' => form_boolean()
    ]
];