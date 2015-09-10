<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use common\models\Department;
use yii\widgets\MaskedInput;

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
    <?= $form->field($model, 'personal_id')->widget(MaskedInput::className(), [
    'mask' => '9-9999-99999-99-9']) ?>
  </div>
  <div class="col-md-4">
    <?= $form->field($model, 'department_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => ArrayHelper::map(Department::find()->all(),'id','name'), // set the initial display text
        'options' => ['placeholder' => 'เลือกแผนก ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <?php $form->field($model, 'department_id')->dropdownList(ArrayHelper::map(Department::find()->all(),'id','name')) ?>
  </div>
  <div class="col-md-4">
    <?= $form->field($model, 'ceallphone')->widget(MaskedInput::className(), [
    'mask' => '999-9999999']) ?>
  </div>
</div>


<?= $form->field($model, 'skill')->widget(\kartik\widgets\Select2::classname(), [
    'data' => $model->getItemSkill(), // set the initial display text
    'options' => ['placeholder' => 'เลือกทักษะ ...','multiple' => true],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>



</fieldset>
<fieldset  style="margin-top:30px">
  <legend>ข้อมูลบัญชี</legend>
  <?= $form->field($modelUser, 'username')->textInput(['maxlength' => true]) ?>
  <div class="row">
    <div class="col-lg-6">
        <?= $form->field($modelUser, 'password')->passwordInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-6">
      <?= $form->field($modelUser, 'confirm_password')->passwordInput(['maxlength' => true]) ?>
    </div>
  </div>
  <?= $form->field($modelUser, 'email')->textInput(['maxlength' => true]) ?>

  <?= $form->field($modelUser, 'roles')->checkboxList($modelUser->getAllRoles()) ?>

  <?= $form->field($modelUser, 'status')->radioList($modelUser->getItemStatus()) ?>

</fieldset


  <div class="form-group">
      <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . ' btn-block btn-lg']) ?>
  </div>

    <?php ActiveForm::end(); ?>

</div>
