<?php

namespace backend\controllers;

use Yii;
use common\models\Booking;
use common\models\BookingSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BookingController implements the CRUD actions for Booking model.
 */
class BookingController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [
                            'index',
                            'view',
                            'create',
                            'update',
                            'delete',
                            'confirm',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Booking models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Booking model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $model->viewed = 2;
        $model->update(false);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Booking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Booking();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Booking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->confirm){
            Yii::$app->session->setFlash('error', 'Нельзя изменить подтвержденную запись, сначала отмените подтверждение.');
            return $this->redirect(Yii::$app->request->referrer);
        }
        $model->done_at = time();
        $model->viewed = 2;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Booking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->confirm){
            Yii::$app->session->setFlash('error', 'Нельзя удалить подтвержденную запись, сначала отмените подтверждение.');
            return $this->redirect(Yii::$app->request->referrer);
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Booking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Booking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Booking::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @param $confirm
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionConfirm($id, $confirm)
    {

            $model = $this->findModel($id);

            $model->confirm = (integer) $confirm;
            $model->viewed = 2;
            $model->done_at = time();

            if (!$model->tour_id){
                Yii::$app->session->setFlash('error', 'Не выбран тур');
                return $this->redirect(Yii::$app->request->referrer);
            }

            if (!$model->month_id){
                Yii::$app->session->setFlash('error', 'Не выбран месяц');
                return $this->redirect(Yii::$app->request->referrer);
            }

            if ($stageModel = $model->stage){
                if ($stageModel->places < $model->user_places_count){
                    Yii::$app->session->setFlash('error', 'Недостаточно мест');
                    return $this->redirect(Yii::$app->request->referrer);
                }
                $stageModel->places = $confirm
                    ?$stageModel->places - $model->user_places_count
                    :$stageModel->places + $model->user_places_count;

            }else{
                Yii::$app->session->setFlash('error', 'Не выбран период заезда');
                return $this->redirect(Yii::$app->request->referrer);
            }

            if ($model->save() && $stageModel->save(false)){
                Yii::$app->session->setFlash('success', 'Операция выполнена успешно');
                return $this->redirect(Yii::$app->request->referrer);
            }
        Yii::$app->session->setFlash('error', 'Что то пошло не так');
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @param \yii\base\Action $action
     * @param mixed $result
     * @return mixed
     */
    public function afterAction($action, $result)
    {
        if ($action->id === 'index'){
            Booking::updateAll(['viewed' => 1], 'viewed = 0');
        }
        return parent::afterAction($action, $result); // TODO: Change the autogenerated stub
    }
}
