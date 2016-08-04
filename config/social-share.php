<?php

return [
    'separator' => '&',
    'services' => [
        'facebook' => [
            'uri' => 'https://www.facebook.com/sharer/sharer.php', 
            'urlName' => 'u', 
            'image' =>'faceebok'
        ],
        'odnoklassniki' => [
            'uri' => 'https://connect.ok.ru/offer',
            'only' => [
                'url'
            ]
        ],
        'google-plus' => [
            'uri' => 'https://plus.google.com/share', 
            'only' => [ 'url' ]
        ],
        'twitter' => [
            'uri' => 'https://twitter.com/intent/tweet',
            'titleName' => 'text'
        ],
        'vkontakte' => [
            'uri' => 'http://vk.com/share.php', 
            'mediaName' => 'image', 
            'extra' => [
                'noparse' => 'false',
            ]
        ],
    ],
];
