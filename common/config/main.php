<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => [
        'comments', 
        'yee',
    ],
    'language' => 'en-US',
    'sourceLanguage' => 'en-US',
    'components' => [
        'ADwords'   => [
            'class'            => 'tprog\adwordsapi\ADwords',
            'developerToken'   => '***************',
            'server_version'   => 'v201506',
            'userAgent'        => 'You Adwords API client',
            'clientCustomerId' => '***-***-****',
            'client'           => [
                'client_id'     => '***************',
                'client_secret' => '***************',
                'refresh_token'    => '***************',
            ],
        ],
        'metaTags' => [
            'class' => 'v0lume\yii2\metaTags\MetaTagsComponent',
            'generateCsrf' => false,
            'generateOg' => true,
        ],
        'yee' => [
            'class' => 'yeesoft\Yee',
        ],
        'settings' => [
            'class' => 'yeesoft\components\Settings'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'yeesoft\components\User',
            'on afterLogin' => function ($event) {
                \yeesoft\models\UserVisitLog::newVisitor($event->identity->id);
            }
        ],
    ],
    'modules' => [
        'iviewer' => [
            'class' => 'hoomanMirghasemi\iviewer\Module',
            'loadingText' => 'loading ...',
        ],
        'attachments' => [
            'class' => nemmo\attachments\Module::className(),
            'tempPath' => '@frontend/web/uploads/temp',
            'storePath' => '@frontend/web/uploads/store',
            'rules' => [ // Rules according to the FileValidator
                'maxFiles' => 10, // Allow to upload maximum 3 files, default to 3
            	'mimeTypes' => ['image/png', 'image/jpeg'], // Only png, jpg images
            	'maxSize' => 1024 * 1024 // 1 MB
            ],
            'tableName' => '{{%attachment}}' // Optional, default to 'attach_file'
	],
        'comments' => [
            'class' => 'yeesoft\comments\Comments',
            'userModel' => 'yeesoft\models\User',
            'userAvatar' => function ($user_id) {
                $user = yeesoft\models\User::findIdentity((int)$user_id);
                if ($user instanceof yeesoft\models\User) {
                    return $user->getAvatar();
                }
                return false;
            }
        ],
    ],
];
