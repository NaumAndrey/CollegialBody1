<?php /** @noinspection ClassConstantCanBeUsedInspection */

$params = require __DIR__ . '/params-local.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'app\commands',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => '@runtime/logs/debug.log',
                    'categories' => ['console\helpers\*'],
                ],
            ],
        ],
        'db' => $db,
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'urlManager' => [
            'scriptUrl' => '/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => $params['base-url']
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV && class_exists('yii\gii\Module')) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
