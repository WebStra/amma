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
            'title' => 'Category',
            'output' => function($row){
                if($row->category)
                    return $row->category->name;

                return 'no category';
            }
        ],

        'name',

        'group',

        'normalized',

        'sub_categories' => [
            'title' => 'Sub categories',
            'output' => function($row){
                $sub_categories = 'N\a';
                $pattern = '<p>%s</p>';

                if(count($sub_cat = $row->subCategories))
                    $sub_cat->each(function($subCategory) use (&$sub_categories, $pattern)
                    {
                        if($sub_categories == 'N\a')
                        {
                            $sub_categories = sprintf($pattern, $subCategory->present()->renderName());
                        } else {
                            $sub_categories .= sprintf($pattern, $subCategory->present()->renderName());
                        }
                    });

                return $sub_categories;
            }
        ],

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

        'category_id' => filter_select('Category', function(){
            $items = [ '' => '-- Any --' ];

            $categories = Category::select('*')->active()->get();

            foreach ($categories as $item) {
                $items[$item->id] = $item->name;
            }

            return $items;
        }),

        'group' => filter_select('Group', function(){
            $items = [ '' => "-- Any --" ];

            $groups = \App\TagTranslation::select('group')
                ->pluck('group')
                ->toArray();

            if(count($groups))
            {
                $groups = array_filter($groups, function($group) use (&$groups){
                    return (bool) $group;
                });

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

        'group' => [
            'type' => 'text_select',
            'description' => '(Optional)',
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

        'sub_categories' => form_select('Sub categories', function (){
            $items = [ '' => '-- No --' ];

            $categories = \App\SubCategory::select('*')->active()->get();

            foreach ($categories as $item) {
                $category = $item->category;
                if($category)
                {
                    $categoryName = $category->present()->renderName();
                } else {
                    $categoryName = 'no Parent';
                }
                $items[$item->id] = sprintf('%s - %s', $categoryName, $item->name);
            }

            return $items;
        }, true, [ 'style' => 'max-width: 300px; min-height:450px' ])
            + description('Specific subcategories for needs.'),

        //'normalized' => form_text(),

        'active' => form_boolean()
    ]
];