<?php

namespace backend\controllers;

use backend\actions\Publish;
use backend\actions\Rank;
use backend\actions\SetImage;
use common\models\Month;
use common\models\Stage;
use Yii;
use common\models\StagePrice;
use common\models\StagePriceSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StagePriceController implements the CRUD actions for StagePrice model.
 */
class StagePriceController extends Controller
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
     * @return array
     */
    public function actions()
    {
        return [
            'publish' => [
                'class' => Publish::className()
            ],
            'rank' => [
                'class' => Rank::className()
            ],
            'set-image' => [
                'class' => SetImage::className(),
                'folder' => 'stage_price_image',
                'propImage' => 'image',
                'title' => 'Изображение цены',
                'width' => 200,
                'height' => 400,
            ],
        ];
    }

    /**
     * Lists all StagePrice models.
     * @param $stage_id
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex($stage_id)
    {
        $searchModel = new StagePriceSearch();
        $searchModel->stage_id = $stage_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $stageModel = Stage::findOne($stage_id);
        $startDate = $stageModel?Yii::$app->formatter->asDate($stageModel->start_date, 'php:d.m.Y'):'';
        $endDate = $stageModel?Yii::$app->formatter->asDate($stageModel->end_date, 'php:d.m.Y'):'';
        $title = 'Цены потока с ' . $startDate . ' по ' . $endDate;


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => $title,
        ]);
    }

    /**
     * Displays a single StagePrice model.
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
     * Creates a new StagePrice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param $stage_id
     * @return mixed
     */
    public function actionCreate($stage_id)
    {
        $model = new StagePrice();
        $model->stage_id = $stage_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StagePrice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StagePrice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $redirect_id = $model->stage_id;
        $model->delete();

        return $this->redirect(['index', 'stage_id' => $redirect_id]);
    }

    /**
     * Finds the StagePrice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StagePrice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id)
    {
        if (($model = StagePrice::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрпашиваемая страница не найдена.');
    }
}
