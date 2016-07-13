<?php

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

        'contact_map::lat' => ['type' => 'text'],

        'contact_info::adress' => ['type' => 'text'],

        'contact_info::email' => ['type' => 'email'],

        'contact_info::executivPhone' => ['type' => 'text'],

        'contact_info::sellPhone' => ['type' => 'text'],

        'contact_info::tehnicPhone' => ['type' => 'text'],

        'support::email' => ['type' => 'email'],

        'site::about' => ['type' => 'textarea'],

//        'site::roles' => [
//            'type'    => 'select',
//            'options' => ['guest', 'member', 'admin', 'content manager']
//        ],

        'site::down' => [
            'type' => 'select',
            'options' => [
                1 => '-- Enable --',
                0 => '-- Disable --'
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