<?php

namespace backend\controllers;

use common\models\PriceSection;
use Yii;
use common\models\Tour;
use common\models\TourSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use zxbodya\yii2\galleryManager\GalleryManagerAction;

/**
 * TourController implements the CRUD actions for Tour model.
 */
class TourController extends Controller
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
                            'rank',
                            'publish',
                            'price',
                            'price-item',
                            'price-section',
                            'price-value',
                            'attrs',
                            'knows',
                            'accoms',
                            'galleryApi',
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
     * @return array
     */
    public function actions()
    {
        return [
            'galleryApi' => [
                'class' => GalleryManagerAction::className(),
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'tour' => Tour::className(),
                ]
            ],
        ];
    }

    /**
     * Lists all Tour models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TourSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tour model.
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
     * Creates a new Tour model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tour();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tour model.
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
     * Deletes an existing Tour model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->bookings){
            $model->deleted = 1;
            $model->save(false);
        }else{
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tour model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tour the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tour::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $alias
     * @param $rank
     * @return \yii\web\Response
     */
    public function actionRank($alias, $rank)
    {
        if (Yii::$app->request->isAjax){

            $model = Tour::findOne(['alias' => $alias]);

            if ($model){
                $model->rank = (integer) $rank;

                if ($model->save()){
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
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

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionPrice($id)
    {
        $model = $this->findModel($id);
        $priceSections = $this->getPriceSections();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->saveTourPrice($model->tourPrice);
            return $this->redirect(['price', 'id' => $model->id]);
        }

        return $this->render('price', [
            'model' => $model,
            'priceSections' => $priceSections,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionPriceItem($id)
    {
        $model = $this->findModel($id);
        $priceSections = PriceSection::find()
            ->where(['id' => $model->tourPrice])
            ->with('priceItems')
            ->all();


        return $this->render('price-item', [
            'model' => $model,
            'priceSections' => $priceSections,
        ]);
    }

    public function getPriceSections()
    {
        return ArrayHelper::map(PriceSection::find()->all(), 'id', 'title');
    }

    public function actionPriceValue($id, $value, $tour_id)
    {
        if (Yii::$app->request->isAjax){

            $model = Tour::findOne(['id' => $tour_id]);

            if ($model){

                $model->saveTourPriceItem($id, $tour_id, $value);

            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionAttrs($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->saveTourAttr($model->selectedTourAttr);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('attrs', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionKnows($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->saveTourKnow($model->selectedTourKnow);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('knows', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionAccoms($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->saveTourAccom($model->selectedTourAccom);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('accoms', [
            'model' => $model,
        ]);
    }

}
