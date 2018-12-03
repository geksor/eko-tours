<?php

namespace backend\controllers;

use common\models\Month;
use Yii;
use common\models\Stage;
use common\models\StageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StageController implements the CRUD actions for Stage model.
 */
class StageController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Stage models.
     * @return mixed
     */
    public function actionIndex($month_id)
    {
        $searchModel = new StageSearch();
        $searchModel->month_id = $month_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $monthModel = Month::findOne($month_id);
        $title = $monthModel?Yii::$app->formatter->asDate($monthModel->title, 'php:F Y'):'';
        $title = 'Потоки ' . $title;


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => $title,
        ]);
    }

    /**
     * Displays a single Stage model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Stage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($month_id)
    {
        $model = new Stage();
        $model->month_id = $month_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Stage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->start_date){
            $model->start_date = Yii::$app->formatter->asDate((integer)$model->start_date, 'php:d.m.Y');
        }
        if ($model->end_date){
            $model->end_date = Yii::$app->formatter->asDate((integer)$model->end_date, 'php:d.m.Y');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Stage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $redirect_id = $model->month_id;
        if ($model->bookings){
            $model->deleted = 1;
            $model->save(false);
        }else{
            $model->delete();
        }
        return $this->redirect(['index', 'month_id' => $redirect_id]);
    }

    /**
     * Finds the Stage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stage::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * @param $id
     * @param $publish
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionPublish($id, $publish)
    {
        if (Yii::$app->request->isAjax){

            $model = $this->findModel($id);

            $model->publish = (integer) $publish;

            if ($model->save()){
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

}
