<?php

use App\Category;

return [
    'title' => 'Site',

    'model' => 'Keyhunter\Administrator\Model\Settings',

    'rules' => [
        'admin::email'   => 'required|email',
        'support::email' => 'required|email'
    ],

    'edit_fields' => [
        'admin::email' => ['type' => 'email'],

        'support::email' => ['type' => 'email'],

        'site::about' => ['type' => 'textarea'],

//        'site::roles' => [
//            'type'    => 'select',
//            'options' => ['guest', 'member', 'admin', 'content manager']
//        ],

        'homepage::popular_category' => [
            'type' => 'select',
            'label' => 'Popular category',
            'options' => function () {
                return Category::select("*")
                    ->child()
                    ->active()
                    ->get()
                    ->pluck('name', 'id');
            }
        ],

        'home::category_first' => [
            'type' => 'select',
            'label' => 'Homepage first category',
            'options' => function () {
                return Category::select("*")
                    ->child()
                    ->active()
//                    ->translated()
                    ->get()
                    ->pluck('name', 'id')
                    ->prepend('-- No --', '');
            }
        ],

        'home::category_second' => [
            'type' => 'select',
            'label' => 'Homepage second category',
            'options' => function () {
                return Category::select("*")
                    ->child()
                    ->active()
//                    ->translated()
                    ->get()
                    ->pluck('name', 'id')
                    ->prepend('-- No --', '');
            }
        ],

        'site::down' => [
            'type' => 'select',
            'options' => [
                0 => '-- Disable --',
                1 => '-- Enable --'
            ]
        ],

        'site::testing_payment_period' => [
            'label' => 'Activate testing payment wallets',
            'type' => 'select',
            'options' => [
                0 => '-- Disable --',
                1 => '-- Enable --'
            ]],
    ]
];