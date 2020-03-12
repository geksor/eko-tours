<?php

namespace backend\controllers;

use backend\actions\SetImage;
use common\models\Accom;
use common\models\PeriodSearch;
use common\models\Tour;
use common\models\TourPeriod;
use common\models\TourPeriodRooms;
use Yii;
use common\models\Month;
use common\models\MonthSearch;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MonthController implements the CRUD actions for Month model.
 */
class TourPeriodsController extends Controller
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
                            'publish',
                            'set-image',
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

    public function actions()
    {
        return [
            'set-image' => [
                'class' => SetImage::className(),
                'folder' => 'tour_periods',
                'propImage' => 'image',
                'title' => 'Периоды',
                'width' => 490,
                'height' => 322,
            ],
        ];
    }

    /**
     * Lists all Periods models.
     * @return mixed
     */
    public function actionIndex($tour_id)
    {
        $searchModel = new PeriodSearch();
        $searchModel->tour_id = $tour_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $tourModel = Tour::findOne($tour_id);
        $title = $tourModel?$tourModel->title:'';
        $title = 'Периоды ' . $title;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => $title,
        ]);
    }

    /**
     * Displays a single Period model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        /*
        if($model->title) {
            $model->title = date("m.Y", (integer) $model->title);
        }
        */

        $rooms=$this->getRoomsByTourAndPeriod($model->tour_id,$id);

        return $this->render('view', [
            'model' => $model,
            'rooms' => $rooms
        ]);
    }

    /**
     * Creates a new Period model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tour_id)
    {
        $model = new TourPeriod();
        $model->tour_id = $tour_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function getRoomsByTourAndPeriod($tour_id,$period_id){
        $data = (new \yii\db\Query())
            ->select(['accom.id as accom_id', 'accom.title as accom_title', 'room.id', 'room.title', 'room.rank', 'tour_period_rooms.price', 'room.publish'])
            ->from('tour_accom')
            ->join('LEFT JOIN', 'accom', 'accom.id = tour_accom.accom_id')
            ->join('LEFT JOIN', 'room', 'room.accom_id = tour_accom.accom_id')
            ->join('LEFT JOIN', 'tour_period_rooms', 'tour_period_rooms.period_id = :period_id AND tour_period_rooms.room_id = room.id',['period_id'=>$period_id])
            ->where('tour_accom.tour_id=:tour_id',['tour_id'=>$tour_id])
            ->all();

        $accoms=[];
        $rooms=[];
        foreach ($data as $row){
            $accoms[$row["accom_id"]]=$row["accom_title"];
            if($row["id"]!=null) {
                $rooms[$row["accom_id"]][] = $row;
            }
        }

        return ['accoms'=>$accoms, 'rooms'=>$rooms];
    }

    /**
     * Updates an existing Period model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        /*
        if($model->title) {
            $model->title = date("m.Y", (integer) $model->title);
        }
        */


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $rooms=isset($_POST['room'])?$_POST['room']:[];
            $data=[];
            $dataToRemove=[];
            foreach ($rooms as $key=>$row){
                if($row) {
                    $data[] = [$id, $key, $row];
                }else{
                    $dataToRemove[]=$key;
                }
            }

            if($dataToRemove){
                TourPeriodRooms::deleteAll(['AND',
                    ['period_id'=>$id],
                    ['room_id'=>$dataToRemove]]);
            }
            if($data) {
                $db = Yii::$app->db;
                $sql = $db->queryBuilder->batchInsert('tour_period_rooms', ['period_id', 'room_id', 'price'], $data);
                $db->createCommand($sql.' ON DUPLICATE KEY UPDATE price=VALUES(price)')->execute();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        //$accoms=Accom::find()->where(['tour_id'=>[1]])->all();
        $rooms=$this->getRoomsByTourAndPeriod($model->tour_id,$id);
        /*
echo '<pre>';
        print_r($rooms);
        echo '</pre>';
        */
        return $this->render('update', [
            'model' => $model,
            'rooms' => $rooms,
        ]);
    }

    /**
     * Deletes an existing Period model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $redirect_id = $model->tour_id;
        if ($model->bookings){
            $model->deleted = 1;
            $model->save(false);
        }else{
            $model->delete();
        }

        return $this->redirect(['index', 'tour_id' => $redirect_id]);
    }

    /**
     * Finds the Period model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Period the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id)
    {
        if (($model = TourPeriod::findOne($id)) !== null) {
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
