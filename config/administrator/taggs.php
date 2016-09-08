<?php

use App\Tag;
use App\Category;

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
        'id',

        'category_id' => [
            'output' => function($row){
                if($row->category)
                    return $row->category->name;

                return 'no category';
            }
        ],

        'name',

        'group',

        'normalized',

        'active' => [
            'visible' => function () {
            },
            'output' => function ($row) {
                if($row->active)
                    return output_boolean($row);

                return '';
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
        'id' => filter_hidden(),

        'group' => filter_select('Group', function(){
            $items = [ '' => "-- Any --" ];

            $groups = \App\TagTranslation::select('group')
                ->pluck('group')
                ->toArray();

            if(count($groups))
            {
                $groups = array_flip($groups);

                array_walk($groups, function($id, $group) use(&$items){
                    if(! empty($group))
                        $items[$group] = ucfirst($group);
                });
            }

            return $items;
        }, function($query, $value){
            return $query->select('*')
                ->translated()
                ->whereGroup($value);
        }),

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

//        'group' => form_text() + translatable() + description('(Optional)'),
        'group' => [
            'type' => 'text_select',
            'default' => 'Select group or add your\'s new one.',
            'options' => function(){
                return (new \App\Repositories\TagRepository)->getCategoryTagGroups();
            }
        ],

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