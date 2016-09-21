<?php

use App\Category;

return [
    'title' => 'Site',

    'model' => 'Keyhunter\Administrator\Model\Settings',

    'rules' => [
        'admin::email'               => 'required|email',
        'support::email'             => 'required|email',
        'contact_info::adress'       => 'required',
        'contact_info::email'        => 'required|email',
        'contact_info::executivPhone'=> 'required|min:7|max:20',
        'contact_info::sellPhone'    => 'required|min:7|max:20',
        'contact_info::tehnicPhone'  => 'required|min:7|max:20',

    ],

    'edit_fields' => [
        'admin::email' => ['type' => 'email'],

        'contact_map::coords' => ['type' => 'text', 'label' => 'Coordinates Map'],

        'contact_info::adress' => ['type' => 'text', 'label' => 'Adresa noastră'],

        'contact_info::email' => ['type' => 'email', 'label' => 'Adresa electronică'],

        'contact_info::sellPhone' => ['type' => 'text', 'label' => 'Departamentul de vânzări'],

        'contact_info::tehnicPhone' => ['type' => 'text', 'label' => 'Departamentul tehnic'],

        'support::email' => [
            'type' => 'email',
            'label' => 'Support email'
        ],

        'support::phone' => [
            'type' => 'text',
            'label' => 'Support phone'
        ],

        'support::skype' => [
            'type' => 'text',
            'label' => 'Support skype'
        ],

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