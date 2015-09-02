<?php
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;

 ?>
<?php $this->beginContent('@frontend/views/layouts/main.php'); ?>
<?php
echo Nav::widget([
    'items' => [
        [
            'label' => 'Profile',
            'url' => ['profile/index'],
        ],
        [
            'label' => 'Update Profile',
            'url' => ['profile/update'],
        ]
    ],
    'options' => ['class' =>'nav nav-tabs'], // set this to nav-tab to get tab-styled navigation
]);
 ?>

<div style="padding:20px;">

  <?php echo $content; ?>
</div>



<?php $this->endContent(); ?>
