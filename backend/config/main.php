<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
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
    // 'as access'=>[
    //    'class'=>'\common\rbac\AccessControl',
    //    'allowActions'=> ['site/login', 'site/error','debug/*','gii/*']
    // ],
    'as globalAccess'=>[
       'class'=>'\common\rbac\GlobalAccessBehavior',
       'rules'=>[
         [
            'controllers'=>['employee'],
            'allow'=>true,
            'roles'=>['Management']
         ],[
             'controllers'=>['employee'],
             'allow' => false,
         ],[
            'controllers'=>['manage-user'],
            'allow'=>true,
            'roles'=>['ManageUser']
         ],[
             'controllers'=>['manage-user'],
             'allow' => false,
         ],[
            'controllers'=>['site'],
            'allow' => true,
            'roles' => ['@'],
            'actions'=>['logout','error','index']
          ],[
             'controllers'=>['site'],
             'allow' => true,
             'roles' => ['?'],
             'actions'=>['login','error']
         ],
         [
            'allow' => true,
            'roles' => ['ManageUser'],
         ]
        ]
    ],
    'params' => $params,
];
