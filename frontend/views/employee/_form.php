<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php echo $form->errorSummary([$model,$modelUser]); ?>
    <fieldset>
      <legend>ข้อมูลส่วนตัวพนักงาน</legend>

<div class="row">
  <div class="col-md-2">
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
  </div>
  <div class="col-md-5">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
  </div>
  <div class="col-md-5">
    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
  </div>
</div>

<div class="row">
  <div class="col-md-3">
    <?= $form->field($model, 'gender')->dropDownList($model->getItemGender(), ['prompt' => '']) ?>
  </div>
  <div class="col-md-3">
      <?= $form->field($model, 'birthday')->textInput() ?>
  </div>
  <div class="col-md-2">
    <?= $form->field($model, 'height')->textInput() ?>
  </div>
  <div class="col-md-2">
    <?= $form->field($model, 'weight')->textInput() ?>
  </div>
  <div class="col-md-2">
    <?= $form->field($model, 'blood_type')->textInput(['maxlength' => true]) ?>
  </div>
</div>

<div class="row">
  <div class="col-md-3">
    <?= $form->field($model, 'race')->textInput() ?>
    <?php $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>
  </div>
  <div class="col-md-3">
    <?= $form->field($model, 'nationality')->textInput() ?>
  </div>
  <div class="col-md-3">
    <?= $form->field($model, 'religion')->textInput() ?>
  </div>
  <div class="col-md-3">
      <?= $form->field($model, 'salary')->textInput() ?>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <?= $form->field($model, 'personal_id')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '9-9999-99999-99-9',
]) ?>

  </div>
  <div class="col-md-4">
    <?= $form->field($model, 'department_id')->textInput() ?>
  </div>
  <div class="col-md-4">
    <?= $form->field($model, 'ceallphone')->textInput(['maxlength' => true]) ?>
  </div>
</div>



<?= $form->field($model, 'skill')->textInput(['maxlength' => true]) ?>


</fieldset>
<fieldset>
  <legend>ข้อมูลบัญชี</legend>
  <?= $form->field($modelUser, 'username') ?>

  <?= $form->field($modelUser, 'email') ?>

  <?= $form->field($modelUser, 'password')->passwordInput() ?>
</fieldset


  <div class="form-group">
      <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . ' btn-block btn-lg']) ?>
  </div>

    <?php ActiveForm::end(); ?>

</div>
