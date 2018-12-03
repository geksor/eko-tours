<?php
namespace frontend\controllers;

use common\models\AboutPage;
use common\models\Accom;
use common\models\Contact;
use common\models\HomePage;
use common\models\Tour;
use common\models\ToursPage;
use Yii;
use yii\base\InvalidParamException;
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
        $models = Tour::find()->where(['publish' => 1, 'deleted' => 0])->orderBy(['rank' => SORT_ASC])->all();

        $pageParams = new ToursPage();
        $pageParams->load(Yii::$app->params);


        return $this->render('index', [
            'models' => $models,
            'pageParams' => $pageParams,
        ]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionView($alias)
    {
        $model = Tour::find()
            ->where(['alias' => $alias, 'publish' => 1, 'deleted' => 0])
            ->orderBy(['rank' => SORT_ASC])
            ->with([
                'months' => function (\yii\db\ActiveQuery $query) {
                    $query
                        ->andWhere(['publish' => 1])
                        ->andWhere(['>', 'title', strtotime('first day of this month 00:00:00')-100])
                        ->with(['stages' => function (\yii\db\ActiveQuery $query) {
                            $query->andWhere(['publish' => 1])->orderBy(['start_date' => SORT_ASC]);
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
                                ->with(['tourPriceItems'])
                                ->orderBy(['rank' => SORT_ASC]);
                        }])
                        ->orderBy(['rank' => SORT_ASC]);
                },
            ])
            ->one();

        $models = Accom::find()
            ->where(['publish' => 1])
            ->with([
                'rooms' => function (\yii\db\ActiveQuery $query) {
                    $query->andWhere(['publish' => 1])->orderBy(['rank' => SORT_ASC]);
                },
            ])
            ->orderBy(['rank' => SORT_ASC])
            ->all();

//        VarDumper::dump(Yii::$app->formatter->asDate(strtotime('first day of this month 00:00:00')),20,true);die;
        return $this->render('view', [
            'model' => $model,
            'models' => $models,
        ]);
    }
}
