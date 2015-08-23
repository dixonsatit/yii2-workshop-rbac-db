<?php
namespace console\controllers;

use Yii;
use yii\helpers\Console;

class RbacController extends \yii\console\Controller {

  // public function actionInit(){
  //   Console::output('Yii 2 Learning.');
  // }

  // public function actionInit(){
  //
  //   $auth = Yii::$app->authManager;
  //   $auth->removeAll();
  //   Console::output('Removing All! RBAC.....');
  //
  //   $manageUser = $auth->createRole('ManageUser');
  //   $manageUser->description = 'สำหรับจัดการข้อมูลผู้ใช้งาน';
  //   $auth->add($manageUser);
  //
  //   $author = $auth->createRole('Author');
  //   $author->description = 'สำหรับผู้ที่เขียนบทความ';
  //   $auth->add($author);
  //
  //   $editor = $auth->createRole('Editor');
  //   $editor->description = 'สำหรับผู้ที่ตรวจสอบบทความ';
  //   $auth->add($editor);
  //
  //   $admin = $auth->createRole('Admin');
  //   $admin->description = 'สำหรับผู้ดูแลระบบ';
  //   $auth->add($admin);
  //
  //   Console::output('Success! RBAC roles has been added.');
  // }

  public function actionInit(){

      $auth = Yii::$app->authManager;
      $auth->removeAll();
      Console::output('Removing All! RBAC.....');

      $manageUser = $auth->createRole('ManageUser');
      $manageUser->description = 'สำหรับจัดการข้อมูลผู้ใช้งาน';
      $auth->add($manageUser);

      $author = $auth->createRole('Author');
      $author->description = 'สำหรับการเขียนบทความ';
      $auth->add($author);

      $editor = $auth->createRole('Editor');
      $editor->description = 'สำหรับการตรวจสอบบทความ';
      $auth->add($editor);
      $auth->addChild($editor, $author);

      $admin = $auth->createRole('Admin');
      $admin->description = 'สำหรับการดูแลระบบ';
      $auth->add($admin);

      $auth->addChild($admin, $editor);
      $auth->addChild($admin, $manageUser);

      $auth->assign($admin, 1);
      $auth->assign($editor, 2);
      $auth->assign($author, 3);

      Console::output('Success! RBAC roles has been added.');
  }

}
?>
