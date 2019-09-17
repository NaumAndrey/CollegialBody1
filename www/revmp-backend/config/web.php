<?php /** @noinspection ClassConstantCanBeUsedInspection */

$params = require __DIR__ . '/params-local.php';
$db = require __DIR__ . '/db.php';

$config = [
    'language' => 'ru-RU',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'fileStorage' => [
            'class' => 'trntv\filekit\Storage',
            'filesystem' => [
                'class' => 'creocoder\flysystem\LocalFilesystem',
                'path' => '@webroot/files',
            ],
        ],
        'request' => [
            'baseUrl' => '',
            'enableCookieValidation' => false,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'user' => [
            'identityClass' => 'app\models\TorisUser',
            'loginUrl' => ['/api/auth/access'],
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
        'db' => $db,
        'torisAuthService' => [
            'class' => 'app\modules\auth\services\AuthService',
            'domain' => $params['torisSettings']['domain'],
            'code' => $params['torisSettings']['code'],
            'urn' => $params['torisSettings']['urn'],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'api/<controller:[\w\-]+>/<action:[\w\-]+>/<id:\d+>' => '<controller>/<action>',
                'api/<controller:[\w\-]+>/<action:[\w\-]+>' => '<controller>/<action>',
                'api/<module:[\w\-]+>/<controller:[\w\-]+>/<action:[\w\-]+>/<id:\d+>' => '<module>/<controller>/<action>',
                'api/<module:[\w\-]+>/<controller:[\w\-]+>/<action:[\w\-]+>' => '<module>/<controller>/<action>',
            ],
        ],
    ],
    'modules' => [
        'auth' => [
            'class' => app\modules\auth\TorisRbacModule::class,
            'roleAdmin' => '[urn:eis:toris:revmp]urn:role:revmp:admin',
            'roleObserver' => '[urn:eis:toris:revmp]urn:role:revmp:observer',
            'roleCulture' => '[urn:eis:toris:revmp]urn:role:revmp:culture',
            'roleTheater' => '[urn:eis:toris:revmp]urn:role:revmp:theater',
            'roleLibrary' => '[urn:eis:toris:revmp]urn:role:revmp:library',
            'roleCinema' => '[urn:eis:toris:revmp]urn:role:revmp:cinema',
            'roleLeisure' => '[urn:eis:toris:revmp]urn:role:revmp:leisure',
            'roleMuseum' => '[urn:eis:toris:revmp]urn:role:revmp:museum',
            'roleEducation' => '[urn:eis:toris:revmp]urn:role:revmp:education',
            'rolePark' => '[urn:eis:toris:revmp]urn:role:revmp:park',
            'roleInterdepartmental' => '[urn:eis:toris:revmp]urn:role:revmp:interdepartmental',
            'roleInstitute' => '[urn:eis:toris:revmp]urn:role:revmp:institute',
        ],
    ],
    'params' => $params,
];

return $config;
