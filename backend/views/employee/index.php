<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Employees');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Employee'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'email',
            'fullname',
            'personal_id',
            // 'id',
            // 'title',
            // 'name',
            // 'surname',
            [
              'attribute'=>'gender',
              'filter'=>$searchModel->getItemGender(),
              'value'=>function($model){
                return $model->genderName;
              }
            ],
            // 'birthday',
            // 'height',
            // 'weight',
            // 'blood_type',
            // 'ceallphone',
            // 'email:email',
            // 'personal_id',
            // 'photo',
            // 'nationality',
            // 'race',
            // 'religion',
            // 'skill',
            // 'salary',
            // 'department_id',
            // 'user_id',
            // 'created_by',
            // 'created_at',
            // 'updated_by',
             'updated_at:dateTime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>