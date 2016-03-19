<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            //'class' => 'common\models\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'tutorial' => [
            'class' => 'common\models\Tutorials',
        ],
        
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'assignments' => 'console\rbac\assignments',
            'items' => 'console\rbac\items',
            'rules' => 'console\rbac\rules',
            //'defaultRoles' => ['admin'],
        ]
    ],
    'modules' => [
        // ...
        'gii1' => [
            'class' => 'yii\gii\Module',
            'generators' => [
                'mongoDbModel' => [
                    'class' => 'yii\mongodb\gii\model\Generator'
                ]
            ],
        ],
    ]
];
