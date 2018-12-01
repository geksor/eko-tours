<?php
namespace frontend\controllers;

use common\models\AboutPage;
use common\models\Contact;
use common\models\HomePage;
use common\models\Know;
use common\models\TouristPage;
use common\models\ToursPage;
use Yii;
use yii\base\InvalidParamException;
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

        return $this->render('index', [
            'model' => $model,
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
        $models = Know::find()->orderBy(['rank' => SORT_ASC])->all();

        $pageParams = new TouristPage();
        $pageParams->load(Yii::$app->params);

        return $this->render('tourist', [
            'models' => $models,
            'pageParams' => $pageParams,
        ]);
    }
}
