<?php

namespace frontend\controllers;

use Yii;
use common\models\Blog;
use frontend\models\BlogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\helpers\VarDumper;

/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access'=>[
              'class'=>AccessControl::className(),
              'denyCallback' => function ($rule, $action) {
                  throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
              },
              'rules'=>[
                [
                  'allow'=>true,
                  'actions'=>['index','view','create'],
                  'roles'=>['Author']
                ],
                [
                  'allow'=>true,
                  'actions'=>['update'],
                  'roles'=>['Author'],
                  'matchCallback'=>function($rule,$action){
                    $model = $this->findModel(Yii::$app->request->get('id'));
                    if (\Yii::$app->user->can('UpdateBlog',['model'=>$model])) {
                             return true;
                    }
                  }
                ],
                [
                  'allow'=>true,
                  'actions'=>['delete'],
                  'roles'=>['Admin']
                ]
              ]
            ]
        ];
    }

    /**
     * Lists all Blog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      $manager = Yii::$app->getAuthManager();
      $permission = $manager->getRolesByUser(Yii::$app->user->id);
      //VarDumper::dump($permission,10,true);
      // print_r($manager->checkAccess(Yii::$app->user->id,'Admin'));
      // print_r($manager->checkAccess(Yii::$app->user->id,'Author'));
      // print_r($manager->checkAccess(Yii::$app->user->id,'UpdateBlog'));
      // //print_r($manager->checkAccess(Yii::$app->user->id,'UpdateOwnBlog'));
      // print_r($manager->checkAccess(Yii::$app->user->id,'CreateBlog'));

        $model = new Blog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Blog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
      $model = $this->findModel($id);
      //if (\Yii::$app->user->can('update-app', ['blog' => $model])) {

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }

      // }else{
      //   throw new ForbiddenHttpException('คุณไม่มีสิทธิ์เข้าใช้งานส่วนนี้');
      // }
    }

    /**
     * Deletes an existing Blog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
