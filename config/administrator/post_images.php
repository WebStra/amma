<?php

use App\Image;
use App\Post;
use App\Repositories\PostsRepository;

return [
    'title' => 'Post Images',

    'description' => 'Post images',

    'model' => Image::class,

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

//        'original' => [
//            'title' => 'Original name'
//        ],

        'image' => column_element('', true, '<img src="(:image)" width="100" />'),

        'origin' => [
            'output' => function($row)
            {
                if ($imageable = $row->imageable)
                {
                    return
                        '<a href="/admin/posts?id='.$imageable->id.'">'
                            . ($imageable->getTable() . ': ' . $imageable->title)
                        . '</a>';
                }
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
        return $query->where('imageable_type', Post::class);
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

        'imageable_type' => [
            'type' => 'hidden',
            'value' => Post::class
        ],

        'type' => [
            'type' => 'hidden',
            'value' => 'cover'
        ],

        'imageable_id' => [
            'type' => 'select',
            'label' => 'Choose partner',
            'options' => function()
            {
                return (new PostsRepository())->lists('title', 'id', true);
            }
        ],

        'original' => [
            'title' => 'Image Name',
            'type' => 'text',
            'description' => 'Will be used for `alt` attribute image <strong>(*Optional)</strong>'
        ],

        'image' => [
            'type' => 'image',
            'location' => '/upload/posts/(:imageable_id)',
            'sizes' => [
                'big'     => '870x472',
                'medium'  => '248x156',
            ]
        ]
    ]
];