<?php

namespace frontend\controllers;

use backend\controllers\TourPeriodsController;
use common\models\AboutPage;
use common\models\Accom;
use common\models\Attr;
use common\models\Booking;
use common\models\Category;
use common\models\City;
use common\models\Contact;
use common\models\HomePage;
use common\models\Room;
use common\models\Stage;
use common\models\StagePrice;
use common\models\Tour;
use common\models\TourPeriod;
use common\models\TourPeriodRooms;
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
                'only'  => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow'   => true,
                        'roles'   => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
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
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
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
        if ($category) {
            $categoryModel = Category::find()->whereAlias($category)->withTours()->one();
            $models = $categoryModel->tours;
        } else {
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
            'models'   => $models,
            'category' => $categoryModel,
            //            'pageParams' => $pageParams,
            //            'cityModels' => $cityModels,
            //            'attrModels' => $attrModels,
            //            'city_id' => (integer)$city_id,
            //            'attr_id' => (integer)$attr_id,
        ]);
    }

    /**
     * @return string
     */
    public function getImage($parent_id, $id, $type, $size = 'preview')
    {
        $url = 'uploads/images/'.$type.'/'.$parent_id.'/'.$id.'/preview.jpg';

        if (!file_exists($url)) {
            return 'no_image.png';
        }
        return $url;
    }

    public function getRoomsByTour($tour_id, $period_start = null, $period_end = null)
    {
        $data = (new \yii\db\Query())
            ->select([
                'accom.id as accom_id',
                'accom.title as accom_title',
                'room.id',
                'room.title',
                'room.rank',
                'tour_periods.id as period_id',
                'tour_periods.start as period_start',
                'tour_periods.end as period_end',
                'tour_period_rooms.price',
                'room.publish',
                'gallery_image.id as image_id',
            ])
            ->from('tour_accom')
            ->join('LEFT JOIN', 'accom', 'accom.id = tour_accom.accom_id AND accom.publish="1"')
            ->join('LEFT JOIN', 'room', 'room.accom_id = accom.id AND room.publish="1"')
            ->join('LEFT JOIN', 'tour_periods', 'tour_periods.tour_id = tour_accom.tour_id AND tour_periods.publish="1"')
            //tour_period_rooms.period_id = :period_id AND ,['period_id'=>$period_id]
            ->join('LEFT JOIN', 'tour_period_rooms', 'tour_period_rooms.room_id = room.id AND tour_period_rooms.period_id=tour_periods.id')
            ->join('LEFT JOIN', 'gallery_image',
                '(gallery_image.ownerId = room.id AND gallery_image.id = (select gallery_image.id from gallery_image where gallery_image.ownerId = room.id AND gallery_image.type="room" ORDER BY gallery_image.rank ASC LIMIT 1))')
            ->where('tour_accom.tour_id=:tour_id AND tour_periods.id IS NOT NULL', ['tour_id' => $tour_id]);

        if ($period_start && !$period_end) {
            //$data->andWhere('tour_periods.start>=:start AND tour_periods.end>=:start',['start'=>$period_start]);
            $data->andWhere(':start BETWEEN tour_periods.start AND tour_periods.end', ['start' => $period_start]);
        }

        if ($period_end && !$period_start) {
            //$data->andWhere('tour_periods.start>=:end AND tour_periods.end<=:end',['end'=>$period_end]);
            $data->andWhere(':end BETWEEN tour_periods.start AND tour_periods.end', ['end' => $period_end]);
        }


        if ($period_start && $period_end) {
            //$data->andWhere('(tour_periods.start>=:start AND tour_periods.end>=:start) OR (tour_periods.start>=:end AND tour_periods.end<=:end)',['start'=>$period_start,'end'=>$period_end]);
            $data->andWhere('(:start BETWEEN tour_periods.start AND tour_periods.end) OR (:end BETWEEN tour_periods.start AND tour_periods.end) OR (tour_periods.start >= :start AND tour_periods.end <= :end)',
                ['start' => $period_start, 'end' => $period_end]);
        }

        $data->orderBy("tour_periods.start ASC, tour_periods.end ASC");

        $data = $data->all();
//echo $data->createCommand()->rawSql;
        $rooms = [];
        foreach ($data as $row) {
            $rooms[$row["period_start"]][$row["period_end"]][$row["accom_id"]]["id"] = $row["accom_id"];
            $rooms[$row["period_start"]][$row["period_end"]][$row["accom_id"]]["title"] = $row["accom_title"];
            if ($row["id"]) {
                $image = null;
                if ($row["image_id"]) {
                    $image = $this->getImage($row["id"], $row["image_id"], 'room', 'medium');
                } else {
                    $image = 'no_image.png';
                }
                $rooms[$row["period_start"]][$row["period_end"]][$row["accom_id"]]["items"][] = [
                    "id"    => $row["id"],
                    "title" => $row["title"],
                    "rank"  => $row["rank"],
                    "price" => $row["price"],
                    "image" => $image,
                    "period_id" => $row["period_id"]
                ];
            }
        }

        //asort($rooms);
        /*
        echo '<pre>';
        print_r($rooms);
        echo '</pre>';
        */
        return $rooms;
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
                'months'        => function (\yii\db\ActiveQuery $query) {
                    $query
                        ->andWhere(['publish' => 1])
                        ->andWhere(['>', 'title', strtotime('first day of this month 00:00:00') - 100])
                        ->with([
                            'stages' => function (\yii\db\ActiveQuery $query) {
                                $query
                                    ->andWhere(['publish' => 1])
                                    ->andWhere(['>', 'start_date', strtotime('today') - 100])
                                    ->orderBy(['start_date' => SORT_ASC]);
                            },
                        ])
                        ->orderBy(['title' => SORT_ASC]);
                },
                'reviews'       => function (\yii\db\ActiveQuery $query) {
                    $query
                        ->andWhere(['publish' => 1])
                        ->orderBy(['rank' => SORT_ASC]);
                },
                'timetableDays' => function (\yii\db\ActiveQuery $query) {
                    $query
                        ->with([
                            'timetableItems' => function (\yii\db\ActiveQuery $query) {
                                $query->andWhere(['publish' => 1])->orderBy(['start_time' => SORT_ASC]);
                            },
                        ])
                        ->orderBy(['day_number' => SORT_ASC]);
                },
                'knows'         => function (\yii\db\ActiveQuery $query) {
                    $query->orderBy(['rank' => SORT_ASC]);
                },
                'priceSections' => function (\yii\db\ActiveQuery $query) {
                    $query
                        ->with([
                            'priceItems' => function (\yii\db\ActiveQuery $query) {
                                $query
                                    ->with([
                                        'tourPriceItems' => function (\yii\db\ActiveQuery $query) {
                                            $query->where(['tour_id' => $this->tourId]);
                                        },
                                    ])
                                    ->orderBy(['rank' => SORT_ASC]);
                            },
                        ])
                        ->orderBy(['rank' => SORT_ASC]);
                },
                'accoms'        => function (\yii\db\ActiveQuery $query) {
                    $query
                        ->where(['publish' => 1])
                        ->with([
                            'rooms' => function (\yii\db\ActiveQuery $query) {
                                $query
                                    ->andWhere(['publish' => 1])
                                    ->orderBy(['rank' => SORT_ASC]);
                            },
                        ])
                        ->orderBy(['rank' => SORT_ASC]);
                },
            ])
            ->one();

        $monthsIdArr = ArrayHelper::getColumn($model->months, 'id');
        $stageModels = Stage::getModelsByMonthIds($monthsIdArr);

//        $pageParamsTours = new ToursPage();
//        $pageParamsTours->load(Yii::$app->params);

        list($tourPeriodsController) = Yii::$app->createController('TourPeriodsController');
//echo $model->id;exit;
        return $this->render('view', [
            'model'       => $model,
            'category'    => $category,
            'stageModels' => $stageModels['models'],
            'stageAccoms' => $stageModels['accoms'],
            'stagePrices' => $stageModels['prices'],
            'rooms'       => $this->getRoomsByTour($model->id)
            //            'pageParamsTours' => $pageParamsTours,
        ]);
    }

    public function actionRooms()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (!\Yii::$app->request->isAjax) {
            return json_encode(["Error" => "Не переданы обязательные параметры"]);
        }

        $id = Yii::$app->request->post("id");
        $dateFrom = Yii::$app->request->post("dateFrom");
        $dateTo = Yii::$app->request->post("dateTo");

        if(!$id||!$dateFrom||!$dateTo){
            return json_encode(["Error" => "Не переданы обязательные параметры"]);
        }

        return json_encode(["response"=>$this->renderPartial('rooms', [
            'rooms' => $this->getRoomsByTour($id,$dateFrom,$dateTo),
        ])]);
    }

    public function actionRoom($category = null, $alias = null, $id = null,$period_id = null,$date_from = null,$date_to = null)
    {
        $category = Category::find()->whereAlias($category)->one();
        $tour = Tour::findOne(['alias' => $alias]);
        $room = Room::findOne($id);
        $tourPeriodRoom = TourPeriodRooms::findOne(['period_id' => $period_id, 'room_id' => $id]);
        //$room=$tourPeriodRoom->room;
        $price=$tourPeriodRoom->price;
        $period = TourPeriod::findOne($period_id);
        //$period=$tourPeriodRoom->period;

        if(!$category||!$tour||!$room||!$period){
            throw new \yii\web\NotFoundHttpException();
        }

        $booking = new Booking();

        return $this->render('room-date', [
            'tour'       => $tour,
            'category'    => $category,
            'room' => $room,
            'price' => $price,
            'period' => $period,
            'booking' => $booking,
        ]);
    }

    public function actionBooking()
    {
        $model = new Booking();
        $contact = new Contact();
        $contact->load(Yii::$app->params);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->lastName || $model->agree === 0) {
                return $this->redirect(Yii::$app->request->referrer);
            }
            $model->tour_id = $model->tour_id ? $model->tour_id : '0';
            $model->month_id = $model->month_id ? $model->month_id : '0';
            $model->stage_id = $model->stage_id ? $model->stage_id : '0';

            if ($model->save()) {
                Yii::$app->session->setFlash('popUp', 'Операция выполнена успешно. Ожидайте звонка специалиста.');
                Yii::$app->session->setFlash('reachGoal_tour_brone');

                $tour = $model->tour_id ? $model->tour->title."\n" : '';
                $month = $model->month_id ? Yii::$app->formatter->asDate($model->month->title, 'php:M Y')."\n" : '';
                try {
                    $stage = $model->stage_id
                        ? 'с '.Yii::$app->formatter->asDate($model->stage->start_date, 'php:d.m')
                        .' по '.Yii::$app->formatter->asDate($model->stage->end_date, 'php:d.m')."\n"
                        : '';
                } catch (InvalidConfigException $e) {
                }

                if (!$contact->chatId) {
                    $message = "Бронь тура\nИмя: $model->customer_name \nТелефон: $model->customer_phone \n$tour $month $stage Чел: $model->user_places_count";
                    \Yii::$app->bot->sendMessage((integer)$contact->chatId, $message);
                }
                if ($contact->email) {
                    $model->sendEmail();
                }
            } else {
                Yii::$app->session->setFlash('popUp', 'Что то пошло не так. Попробуйте еще раз.');
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
