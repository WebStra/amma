<?php

return [
    'title' => 'Users Products',

    'description' => 'Users products relations list.',

    'model' => 'App\UserProducts',

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

        'user_id' => [
            'title' => 'User',
            'output' => function ($row){
                return sprintf('<a href="/admin/members?id=%s">%s</a>', $row->user->id, $row->user->email);
            }
        ],

        'product_id' => [
            'title' => 'Product',
            'output' => function ($row){
                return sprintf('<a href="/admin/products?id=%s">go to product: %s</a>', $row->product->id, $row->product->name);
            }
        ],

        'seller_id' => [
            'title' => 'Seller',
            'output' => function ($row){
                return sprintf('<a href="/admin/sellers?id=%s">go to seller: %s</a>', $row->seller->id, $row->seller->name);
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
        'user_id' => filter_select('User', function (){
            return \App\Seller::leftJoin('users', 'sellers.user_id', '=', 'users.id')
                ->select('users.email', 'sellers.*')
                ->get()
                ->pluck('email', 'user_id')
                ->prepend('-- Any --', '');
        }),

        'seller_id' => filter_select('Seller', function (){
            return \App\UserProducts::leftJoin('sellers', 'users_products.seller_id', '=', 'sellers.id')
                ->select('sellers.name', 'users_products.*')
                ->get()
                ->pluck('name', 'seller_id')
                ->prepend('-- Any --', '');
        })
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
        'id' => form_key()
    ]
];