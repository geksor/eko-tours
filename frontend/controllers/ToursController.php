<?php
namespace frontend\controllers;

use common\models\AboutPage;
use common\models\Accom;
use common\models\Attr;
use common\models\Booking;
use common\models\Category;
use common\models\City;
use common\models\Contact;
use common\models\HomePage;
use common\models\Stage;
use common\models\StagePrice;
use common\models\Tour;
use common\models\ToursPage;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class ToursController extends Controller
{
    public $tourId;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @param $category
     * @return mixed
     */
    public function actionIndex($category = null)/* $city_id = null, $attr_id = null (old variable) */
    {
        if ($category){
            $categoryModel = Category::find()->whereAlias($category)->withTours()->one();
            $models = $categoryModel->tours;
        }else{
            $this->redirect('/');
        }
//        if ($city_id){
//            $models = $query->andWhere(['city_id' => $city_id])->all();
//        }elseif ($attr_id){
//            $models = Attr::findOne($attr_id)->toursPublish;
//        }else{
//            $models = $query->all();
//        }

//        $cityModels = City::find()->orderBy(['rank' => SORT_ASC])->with('tours')->all();
//        $attrModels = Attr::find()->orderBy(['rank' => SORT_ASC])->with('tours')->all();

//        $pageParams = new ToursPage();
//        $pageParams->load(Yii::$app->params);


        return $this->render('index', [
            'models' => $models,
            'category' => $categoryModel,
//            'pageParams' => $pageParams,
//            'cityModels' => $cityModels,
//            'attrModels' => $attrModels,
//            'city_id' => (integer)$city_id,
//            'attr_id' => (integer)$attr_id,
        ]);
    }

    /**
     * @param $category
     * @param $alias
     * @return string
     */
    public function actionView($category = null, $alias = null)
    {
        $category = Category::find()->whereAlias($category)->one();
        $this->tourId = Tour::findOne(['alias' => $alias])->id;
        $model = Tour::find()
            ->where(['alias' => $alias, 'publish' => 1, 'deleted' => 0])
            ->orderBy(['rank' => SORT_ASC])
            ->with([
                'months' => function (\yii\db\ActiveQuery $query) {
                    $query
                        ->andWhere(['publish' => 1])
                        ->andWhere(['>', 'title', strtotime('first day of this month 00:00:00')-100])
                        ->with(['stages' => function (\yii\db\ActiveQuery $query) {
                            $query
                                ->andWhere(['publish' => 1])
                                ->andWhere(['>', 'start_date', strtotime('today')-100])
                                ->orderBy(['start_date' => SORT_ASC]);
                        }])
                        ->orderBy(['title' => SORT_ASC]);
                },
                'reviews' => function (\yii\db\ActiveQuery $query) {
                    $query
                        ->andWhere(['publish' => 1])
                        ->orderBy(['rank' => SORT_ASC]);
                },
                'timetableDays' => function (\yii\db\ActiveQuery $query) {
                    $query
                        ->with(['timetableItems' => function (\yii\db\ActiveQuery $query) {
                            $query->andWhere(['publish' => 1])->orderBy(['start_time' => SORT_ASC]);
                        }])
                        ->orderBy(['day_number' => SORT_ASC]);
                },
                'knows' => function (\yii\db\ActiveQuery $query) {
                    $query->orderBy(['rank' => SORT_ASC]);
                },
                'priceSections' => function (\yii\db\ActiveQuery $query) {
                    $query
                        ->with(['priceItems' => function (\yii\db\ActiveQuery $query) {
                            $query
                                ->with(['tourPriceItems' => function (\yii\db\ActiveQuery $query) {
                                    $query->where(['tour_id' => $this->tourId]);
                                }])
                                ->orderBy(['rank' => SORT_ASC]);
                        }])
                        ->orderBy(['rank' => SORT_ASC]);
                },
                'accoms' => function (\yii\db\ActiveQuery $query) {
                    $query
                        ->where(['publish' => 1])
                        ->with(['rooms' => function (\yii\db\ActiveQuery $query) {
                            $query
                                ->andWhere(['publish' => 1])
                                ->orderBy(['rank' => SORT_ASC]);
                        }])
                        ->orderBy(['rank' => SORT_ASC]);
                },
            ])
            ->one();

        $monthsIdArr = ArrayHelper::getColumn($model->months, 'id');
        $stageModels = Stage::getModelsByMonthIds($monthsIdArr);

//        $pageParamsTours = new ToursPage();
//        $pageParamsTours->load(Yii::$app->params);

        return $this->render('view', [
            'model' => $model,
            'category' => $category,
            'stageModels' => $stageModels['models'],
            'stageAccoms' => $stageModels['accoms'],
            'stagePrices' => $stageModels['prices'],
//            'pageParamsTours' => $pageParamsTours,
        ]);
    }

    public function actionBooking()
    {
        $model = new Booking();
        $contact = new Contact();
        $contact->load(Yii::$app->params);

        if ($model->load(Yii::$app->request->post())){
            if ($model->lastName || $model->agree === 0){
                return $this->redirect(Yii::$app->request->referrer);
            }
            $model->tour_id = $model->tour_id?$model->tour_id:'0';
            $model->month_id = $model->month_id?$model->month_id:'0';
            $model->stage_id = $model->stage_id?$model->stage_id:'0';
            if ($model->save()){
                Yii::$app->session->setFlash('popUp', 'Операция выполнена успешно. Ожидайте звонка специалиста.');
                Yii::$app->session->setFlash('reachGoal_tour_brone');

                $tour = $model->tour_id?$model->tour->title."\n":'';
                $month = $model->month_id?Yii::$app->formatter->asDate($model->month->title, 'php:M Y')."\n":'';
                try {
                    $stage = $model->stage_id
                        ? 'с ' . Yii::$app->formatter->asDate($model->stage->start_date, 'php:d.m')
                        . ' по ' . Yii::$app->formatter->asDate($model->stage->end_date, 'php:d.m') . "\n"
                        : '';
                } catch (InvalidConfigException $e) {
                }

                if ($contact->chatId){
                    $message = "Бронь тура\nИмя: $model->customer_name \nТелефон: $model->customer_phone \n$tour $month $stage Чел: $model->user_places_count";
                    \Yii::$app->bot->sendMessage((integer)$contact->chatId, $message);
                }
                if ($contact->email){
                    $model->sendEmail();
                }
            }else{
                Yii::$app->session->setFlash('popUp', 'Что то пошло не так. Попробуйте еще раз.');
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
