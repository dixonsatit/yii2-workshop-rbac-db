<?php
namespace common\rbac;
use yii\web\ForbiddenHttpException;
use yii\base\Module;
use Yii;
use yii\web\User;
use yii\di\Instance;

class AccessControl extends \yii\base\ActionFilter
{
    public function beforeAction($action)
    {
      $actionId = $action->getUniqueId();
      $user = $this->getUser();
    }
}
 ?>
