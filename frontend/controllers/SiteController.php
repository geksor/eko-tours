<?php
namespace frontend\controllers;

use common\models\AboutPage;
use common\models\CallBack;
use common\models\City;
use common\models\Contact;
use common\models\Gallery;
use common\models\HomePage;
use common\models\Know;
use common\models\Month;
use common\models\Reviews;
use common\models\TimetablePage;
use common\models\Tour;
use common\models\TouristPage;
use common\models\ToursPage;
use Yii;
use yii\base\InvalidParamException;
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
class SiteController extends Controller
{
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
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new HomePage();
        $model->load(Yii::$app->params);

        $galleryModel = Gallery::findOne(['id' => (integer)$model->gallery_id]);
        $galleryImages = false;
        if ($galleryModel){
            $galleryImages = $galleryModel->getBehavior('galleryBehavior')->getImages();
        }

        return $this->render('index', [
            'model' => $model,
            'galleryImages' => $galleryImages,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new Contact();
        $model->load(Yii::$app->params);

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $model = new AboutPage();
        $model->load(Yii::$app->params);

        $contactModel = new Contact();
        $contactModel->load(Yii::$app->params);

        return $this->render('about', [
            'model' => $model,
            'contactModel' => $contactModel,
        ]);
    }

    public function actionTourist()
    {
        $models = Know::find()->where(['show_on_page' => 1])->orderBy(['rank' => SORT_ASC])->all();

        $pageParams = new TouristPage();
        $pageParams->load(Yii::$app->params);

        return $this->render('tourist', [
            'models' => $models,
            'pageParams' => $pageParams,
        ]);
    }

    public function actionTimetable($id = null)
    {

        $modelsAll = City::find()
        ->with('tours')
        ->orderBy(['rank' => SORT_ASC])
        ->all();

        $modelsId = [];

        foreach ($modelsAll as $item){
            if ($item->tours){
                $modelsId[] = $item->id;
            }
        }

        $models = City::findAll(['id' => $modelsId]);

        if ($models){
            $selectModelQuery = City::find();
            if ($id){
                $selectModelQuery->where(['id' => $id]);
            }else{
                $selectModelQuery->where(['id' => $models[0]->id]);
            }
            $selectModel = $selectModelQuery
                ->with([
                    'tours' => function (\yii\db\ActiveQuery $query) {
                        $query
                            ->andWhere(['publish' => 1, 'deleted' => 0])
                            ->with([
                                'months' => function (\yii\db\ActiveQuery $query) {
                                    $query
                                        ->where(['publish' => 1])
                                        ->andWhere(['>', 'title', strtotime('first day of this month 00:00:00')-100])
                                        ->with(['stages' => function (\yii\db\ActiveQuery $query) {
                                            $query->andWhere(['publish' => 1])->orderBy(['start_date' => SORT_ASC]);
                                        }])
                                        ->orderBy(['title' => SORT_ASC]);
                                },
                            ])
                            ->orderBy(['rank' => SORT_ASC]);
                    },
                ])
                ->one();
        }else{
            return $this->redirect('/');
        }

//        VarDumper::dump($selectModel,20,true);die;

        $pageParams = new TimetablePage();
        $pageParams->load(Yii::$app->params);

        return $this->render('timetable', [
            'models' => $models,
            'selectModel' => $selectModel,
            'pageParams' => $pageParams,
        ]);
    }

    public function actionSendReviews()
    {
        $reviewsModel = new Reviews();
        if ( $reviewsModel->load( Yii::$app->request->post() ) && !$reviewsModel->lastName ) {
            if ($reviewsModel->save()){
                Yii::$app->session->setFlash('popUp', 'Спасибо за ваш отзыв.');
                $message = "Новый отзыв\n Имя: $reviewsModel->user_name \n Текст отзыва: $reviewsModel->text";
                if (ArrayHelper::keyExists('chatId', Yii::$app->params['Contact'])){
                    \Yii::$app->bot->sendMessage((integer)Yii::$app->params['Contact']['chatId'], $message);
                }
                $reviewsModel->sendEmail();
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        Yii::$app->session->setFlash('popUp', 'Что то пошло не так.');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionCallBack()
    {
        $callBackModel = new CallBack();
        if ( $callBackModel->load( Yii::$app->request->post() ) && !$callBackModel->lastName ) {
            if ($callBackModel->save()){
                Yii::$app->session->setFlash('popUp', ' Мы свяжемся с Вами в ближайшее время.');
                $messHeader = $callBackModel->is_consult?'Запрос консультации':'Запрос обратного звонка';
                $message = "$messHeader\n Имя: $callBackModel->user_name \n Телефон: $callBackModel->phone";
                if (ArrayHelper::keyExists('chatId', Yii::$app->params['Contact'])){
                    \Yii::$app->bot->sendMessage((integer)Yii::$app->params['Contact']['chatId'], $message);
                }
                $callBackModel->sendEmail();
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        Yii::$app->session->setFlash('popUp', 'Что то пошло не так.');
        return $this->redirect(Yii::$app->request->referrer);
    }
}
