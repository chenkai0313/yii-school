<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'zju-school',
    'language' => 'zh-CN',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'tree' => [
            'class' => '\getpu\tree\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_zju-school',
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => '_zju-school',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'keyPrefix' => '_zju_', // a unique cache key prefix
        ],
        'view' => [
            'class' => 'frontend\component\View',
        ],
        'devicedetect' => [
            'class' => 'getpu\devicedetect\Devicedetect',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                    [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '.html',
            'rules' => [
                'cyspace' => 'space/cyspace',
                'yspace' => 'space/yspace',
                'research' => 'policy/research',
                '<controller>' => '<controller>/index',
                'news/<cid:\d+>-<id:\d+>' => 'news/detail',
                'activity/<cid:\d+>-<id:\d+>' => 'activity/detail',
                'competition/<cid:\d+>-<id:\d+>' => 'competition/detail',
                'v/play-<id:\d+>' => 'videos/detail',
            ],
        ],
    ],
    'params' => $params,
];
