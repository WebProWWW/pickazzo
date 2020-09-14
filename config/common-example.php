<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 05/07/2020 21:33
 */

return [
    'charset' => 'utf-8',
    'language' => 'ru-RU',
    'sourceLanguage' => 'ru-RU',
    'timeZone' => 'Europe/Moscow',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'formatter' => [
            'dateFormat' => 'dd.MM.Y',
            'timeFormat' => 'HH:mm',
            'datetimeFormat' => 'dd.MM.Y HH:mm',
        ],
        'response' => [
            'formatters' => [
                yii\web\Response::FORMAT_JSON => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                ],
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'YQZrWHI8giRkeAmrQ4ZvdIXvczvU_ijT',
            'parsers' => [ 'application/json' => 'yii\web\JsonParser' ],
        ],
        'authManager' => [
            'class' => components\AuthManager::class,
        ],
        'user' => [
            'identityClass' => models\User::class,
            'enableAutoLogin' => true,
            'enableSession' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/components/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => Swift_SmtpTransport::class,
                'host' => 'smtp.host',
                'username' => 'email@username.com',
                'password' => 'PaSsWoRd',
                'encryption' => 'ssl',
                'port' => 465,
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=pickazzo',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            //Schema cache options (for production environment)
            'enableSchemaCache' => true,
            'schemaCacheDuration' => 60,
            'schemaCache' => 'cache',
        ],
    ],
    'params' => [
        'mailer.noreply' => [
            'noreply@pickazzo.com' => 'Pickazzo.com',
        ],
        'mailer.admins' => [
            'v.timur8484@gmail.com' => 'Тимур',
            'v.timur8484@yandex.ru' => 'Тимур',
        ],
        'user.passwordResetTokenExpire' => 3600,
    ],
];