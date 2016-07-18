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
            'uri' => 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=',
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
