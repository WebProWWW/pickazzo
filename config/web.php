<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 01/06/2020 21:08
 */

return [
    'name' => 'Pickazzo',
    'id' => 'yii-cms-site',
    'controllerNamespace' => 'controllers',
    'components' => [
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enableStrictParsing' => false,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'suffix' => '.html',
                    'pattern' => 'aktivatsiya',
                    'route' => 'site/verify-email',
                ],
                [
                    'suffix' => '.html',
                    'pattern' => 'korzina',
                    'route' => 'user/cart',
                ],
                [
                    'suffix' => '.html',
                    'pattern' => '<alias:[\w\-]+>',
                    'route' => 'site/index',
                    'defaults' => ['alias' => 'index'],
                ],
                [
                    'suffix' => '.json',
                    'pattern' => 'user/login',
                    'route' => 'user/login',
                ],
                [
                    'suffix' => '.json',
                    'pattern' => 'user/registr',
                    'route' => 'user/registr',
                ],
//                [
//                    'suffix' => '.json',
//                    'pattern' => 'user/create-order',
//                    'route' => 'user/create-order',
//                ],
                '' => 'site/index',
            ],
        ],
    ],
];
