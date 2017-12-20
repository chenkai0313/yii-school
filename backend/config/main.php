<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'language' => 'zh-CN',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'setting' => [
            'class' => '\backend\modules\setting\Module',
        ],
        'navbar' => [
            'class' => '\backend\modules\navbar\Module',
        ],
        'files' => [
            'class' => '\backend\modules\files\Module',
        ],

        'cms' =>  [
            'class' => '\backend\modules\cms\Module',
        ],

        'videos' => [
            'class' => 'backend\modules\videos\Module',
        ],

        'tree' => [
            'class' => '\getpu\tree\Module',
        ],

        'user' => [
            'class' => '\getpu\user\Module',
        ],

        'rbac' => [
            'class' => '\getpu\rbac\Module',
        ],

        'mgmt' => [
            'class' => '\getpu\mgmt\Module',
        ],
    ],

    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],

        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],

        'assetManager' => [
            'bundles' => [
                'getpu\lte\LteAsset' => [
                    'depends' => [
                        'getpu\lte\assets\FontAwesomeAsset',
                        'yii\web\YiiAsset',
                        'yii\bootstrap\BootstrapAsset',
                        'yii\bootstrap\BootstrapPluginAsset',
                        'backend\assets\PluginAsset',
                    ],
                ],
            ],
        ],

        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'Y-m-d',
            'datetimeFormat' => 'Y-m-d H:i:s',
            'timeFormat' => 'H:i:s',
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
            'showScriptName'  => false,
            'rules' => [
            ],
        ],

    ],



    'params' => $params,
];
