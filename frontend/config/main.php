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
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
    'as globalAccess'=>[
       'class'=>'\common\rbac\GlobalAccessBehavior',
       'rules'=>[
         [
            'controllers'=>['site','debug/default'],
            'allow' => true,
            'roles' => ['@','?'],
            'actions'=>['error','index','about','contact']
          ],[
            'controllers'=>['site'],
            'allow' => true,
            'roles' => ['@'],
            'actions'=>['logout']
          ],[
            'controllers'=>['site'],
            'allow' => true,
            'roles' => ['?'],
            'actions'=>['signup','login','request-password-reset','reset-password']
          ],[
            'controllers'=>['blog'],
            'allow' => true,
            'roles'  => ['Author']
          ],[
               'controllers'=>['debug/default'],
               'allow' => true,
               'roles' => ['?'],
          ],[
            'allow'=>true,
            'roles'=>['Author']
            ]
        ]
     ],
    'params' => $params,
];
