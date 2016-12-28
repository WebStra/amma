<?php

return [
    'separator' => '&',
    'services' => [
        'facebook' => [
            'uri' => 'https://www.facebook.com/sharer/sharer.php', 
            'urlName' => 'u'
        ],
        'odnoklassniki' => [
            'uri' => 'https://connect.ok.ru/offer'
        ],
        'google-plus' => [
            'uri' => 'https://plus.google.com/share', 
            'only' => [ 'url' ]
        ],
      /*  'twitter' => [
            'uri' => 'https://twitter.com/intent/tweet',
            'titleName' => 'text'
        ],
        'vkontakte' => [
            'uri' => 'http://vk.com/share.php',
            // 'view' => 'share.partials.vkontakte',
            'mediaName' => 'image',
            'extra' => [
                'noparse' => 'false',
            ]
        ],*/
    ],
];
