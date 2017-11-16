<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'backend',
    'homeUrl' => '/admin',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        // ===== My Module ======
        'scenery' => [
            'class' => 'backend\modules\scenery\Region',
        ],
        //=======================
        'settings' => [
            'class' => 'yeesoft\settings\SettingsModule',
        ],
        'menu' => [
            'class' => 'yeesoft\menu\MenuModule',
        ],
        'translation' => [
            'class' => 'yeesoft\translation\TranslationModule',
        ],
        'user' => [
            'class' => 'yeesoft\user\UserModule',
        ],
        'media' => [
            'class' => 'yeesoft\media\MediaModule',
            'routes' => [
                'baseUrl' => '', // Base absolute path to web directory
                'basePath' => '@frontend/web', // Base web directory url
                'uploadPath' => 'uploads', // Path for uploaded files in web directory
            ],
        ],
        'post' => [
            'class' => 'yeesoft\post\PostModule',
        ],
        'page' => [
            'class' => 'yeesoft\page\PageModule',
        ],
        'seo' => [
            'class' => 'yeesoft\seo\SeoModule',
        ],
        'comment' => [
            'class' => 'yeesoft\comment\CommentModule',
        ],
        'eav' => [
            'class' => 'yeesoft\eav\EavModule',
        ],
    ],
    'components' => [
        'request' => [
            'baseUrl' => '/admin',
        ],
        'assetManager' => [
            /*'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@yeesoft/yii2-yee-core/assets/theme/bootswatch/custom',
                    'css' => ['bootstrap.css']
                ],
            ],*/
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@yeesoft/yee-theme/dist',
                    'css' => ['css/theme.min.css']
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => '@yeesoft/yee-theme/dist',
                    'js' => ['js/bootstrap.min.js',]
                ],
            ],
        ],
        'urlManager' => [
            'class' => 'yeesoft\web\MultilingualUrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'multilingualRules' => false,
            'rules' => array(
                //add here local frontend controllers
                //'<controller>' => '<controller>/index',
                //'<controller>/<id:\d+>' => '<controller>/view',
                //'<controller>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                //'<controller>/<action:\w+>' => '<controller>/<action>',
                //yee cms and other modules routes
                '<module>/' => '<module>/default/index',
                '<module>/<action:\w+>/<id:\d+>' => '<module>/default/<action>',
                '<module>/<action:(create)>' => '<module>/default/<action>',
                '<module>/<controller:\w+>' => '<module>/<controller>/index',
                '<module>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                '<module>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
            )
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
    ],
    'params' => $params,
];
