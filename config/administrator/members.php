<?php

use Illuminate\Database\Eloquent\Builder;
use Keyhunter\Administrator\Model\Role;
use App\Wallet;
return [
    'title'  => 'Members',
    'model'  => 'App\User',

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
        'info' => [
            'title'     => 'Info',
            'elements'  => [
                'email' => [
                    'output' => '<a href="mailto:(:email)">(:email)</a>',
                ],
                'name'
            ]
        ],
        'role_id' => [
            'title' => 'Role',
            'output' => function ($row) {
                return $row->role->name;
            }
        ],
        'active' => [
            'visible' => function() {},
            'output' => function($row) {
                return output_boolean($row);
            }
        ],
        'dates' => [
            'title'=> 'Wallet',
            'elements' =>
            [
                'Current Amount' => [
                    'output' => function($row){

                    $ammount = Wallet::where('user_id',$row->id)->pluck('amount')->first();
                    return sprintf('%s',$ammount);
                }],

                'Add Amount' => ['output' => function($row)
                {   $id = Wallet::where('user_id',$row->id)->pluck('id')->first();
                    return sprintf('%s','<a href="/admin/wallet/'.$id.'/edit">Click</a>');
                }],

            ]
        ]
    ],

    /*
    |-------------------------------------------------------
    | Actions available to do, including global
    |-------------------------------------------------------
    |
    | Global actions
    | @todo
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
    'with' => [],

    /*
    |-------------------------------------------------------
    | QueryBuilder
    |-------------------------------------------------------
    |
    | Extend the main scaffold index query
    |
    */
    'query' => function(Builder $query)
    {
        $query->where('role_id', '!=', Role::whereName('admin')->first()->id);
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
        
        'role_id' => [
            'label' => 'Role',
            'type' => 'select',
            'options' => function() {
                $options = [];
                Role::whereActive(1)
                    ->get()
                    ->each(function ($role) use (&$options){
                        $options[$role->id] = $role->name;
                    });

                return ['' => '-- Any --'] + ($options);
            },
            'multiple' => false
        ],

        'active' => [
            'type' => 'select',
            'options' => [
                '' => '-- Any --',
                0 => 'No',
                1 => 'Yes'
            ]
        ],

        'created_at' => [
            'type' => 'date'
        ]
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
        'id'       => ['type' => 'key'],

        'role_id' => [
            'type'    => 'select',
            'options' => function() {
                $options = [];
                Role::whereActive(1)
                    ->get()
                    ->each(function ($role) use (&$options){
                        $options[$role->id] = $role->name;
                    });

                return $options;
            }
        ],

        'email' => [
            'type'  => 'email'
        ],

        'name' => [
            'type' => 'text'
        ],

        'active' => form_boolean()
    ]
];