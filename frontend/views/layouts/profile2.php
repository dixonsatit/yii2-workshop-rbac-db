<?php
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;

 ?>
<?php $this->beginContent('@frontend/views/layouts/main.php'); ?>
<div class="row">
  <div class="col-md-2">
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
    'options' => ['class' =>'"nav nav-pills nav-stacked'], // set this to nav-tab to get tab-styled navigation
]);
 ?>
  </div>
  <div class="col-md-10">
    <?php echo $content; ?>
  </div>
</div>

<?php $this->endContent(); ?>
