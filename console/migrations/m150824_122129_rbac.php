<?php
use \Yii;
use yii\db\Schema;
use yii\db\Migration;
use yii\helpers\Console;

class m150824_122129_rbac extends Migration
{
    public function up()
    {
      $auth = Yii::$app->authManager;
      $auth->removeAll();
      Console::output('Removing All! RBAC.....');

      $rule = new \common\rbac\AuthorRule;
      $auth->add($rule);

      // $index  = $auth->createPermission('blog/index');
      // $auth->add($index);
      // $view   = $auth->createPermission('blog/view');
      // $auth->add($view);
      // $create = $auth->createPermission('blog/create');
      // $auth->add($create);
      // $update = $auth->createPermission('blog/update');
      // $update->ruleName = $rule->name;
      // $auth->add($update);
      // $delete = $auth->createPermission('blog/delete');
      // $auth->add($delete);

      $createPost = $auth->createPermission('createBlog');
      $createPost->description = 'สร้าง blog';
      $auth->add($createPost);

      $updatePost = $auth->createPermission('updateBlog');
      $updatePost->description = 'แก้ไข blog';
      $auth->add($updatePost);

      $loginToBackend = $auth->createPermission('loginToBackend');
      $loginToBackend->description = 'ล็อกอินเข้าใช้งานส่วน backend';
      $auth->add($loginToBackend);

      $manageUser = $auth->createRole('ManageUser');
      $manageUser->description = 'จัดการข้อมูลผู้ใช้งาน';
      $auth->add($manageUser);

      $author = $auth->createRole('Author');
      $author->description = 'การเขียนบทความ';
      $auth->add($author);

      $management = $auth->createRole('Management');
      $management->description = 'จัดการข้อมูลผู้ใช้งานและบทความ';
      $auth->add($management);

      $admin = $auth->createRole('Admin');
      $admin->description = 'สำหรับการดูแลระบบ';
      $auth->add($admin);

      $updateOwnPost = $auth->createPermission('updateOwnPost');
      $updateOwnPost->description = 'แก้ไขบทความตัวเอง';
      $updateOwnPost->ruleName = $rule->name;
      $auth->add($updateOwnPost);

      // $auth->addChild($author,$index);
      // $auth->addChild($author,$view);
      // $auth->addChild($author,$create);
      // $auth->addChild($author,$update);
      // $auth->addChild($management, $delete);

      $auth->addChild($author,$createPost);
      $auth->addChild($updateOwnPost, $updatePost);
      $auth->addChild($author, $updateOwnPost);

      $auth->addChild($manageUser, $loginToBackend);

      $auth->addChild($management, $manageUser);
      $auth->addChild($management, $author);

      $auth->addChild($admin, $management);

      $auth->assign($admin, 1);
      $auth->assign($management, 2);
      $auth->assign($author, 3);
      //$auth->assign($author, 4);

      Console::output('Success! RBAC roles has been added.');
    }

    public function down()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        Console::output('Removing All! RBAC.....');
        return false;

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
