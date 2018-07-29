<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\user\User',
            'enableAutoLogin' => true,
        ],
        'urlManager' => array(
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                "<controller:\w+>/<action:\w+>"=>"<controller>/<action>",
                "<controller:\w+>/<action:\w+>/<id:\d+>"=>"<controller>/<action>",
                "<controller:\w+>/<action:\w+>/id/<id:\d+>"=>"<controller>/<action>",
                "<controller:\w+>/<action:\w+>/aid/<aid:\d+>"=>"<controller>/<action>",
                "<controller:\w+>/<action:\w+>/name/<name:\w+>"=>"<controller>/<action>",
            ],
        ),
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
    ],
    'params' => $params,
];
