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

      $createPost = $auth->createPermission('createBlog');
      $createPost->description = 'Create a application';
      $auth->add($createPost);

      $updatePost = $auth->createPermission('updateBlog');
      $updatePost->description = 'Update application';
      $auth->add($updatePost);

      $admin = $auth->createRole('Admin');
      $auth->add($admin);

      $author = $auth->createRole('Author');
      $auth->add($author);

      $management = $auth->createRole('Management');
      $auth->add($management);

      $rule = new \common\rbac\AuthorRule;
      $auth->add($rule);

      $updateOwnPost = $auth->createPermission('updateOwnPost');
      $updateOwnPost->description = 'Update Own Post';
      $updateOwnPost->ruleName = $rule->name;
      $auth->add($updateOwnPost);

      $auth->addChild($author,$createPost);
      $auth->addChild($updateOwnPost, $updatePost);
      $auth->addChild($author, $updateOwnPost);
      $auth->addChild($management, $author);
      $auth->addChild($admin, $management);

      $auth->assign($admin, 1);
      $auth->assign($management, 2);
      $auth->assign($author, 3);
      $auth->assign($author, 4);

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
