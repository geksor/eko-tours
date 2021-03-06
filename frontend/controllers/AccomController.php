<?php
namespace frontend\controllers;

use common\models\AboutPage;
use common\models\Accom;
use common\models\AccomPage;
use common\models\Contact;
use common\models\HomePage;
use common\models\Tour;
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
class AccomController extends Controller
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
        $models = Accom::find()
            ->where(['publish' => 1])
            ->with([
                'rooms' => function (\yii\db\ActiveQuery $query) {
                    $query->andWhere(['publish' => 1])->orderBy(['rank' => SORT_ASC]);
                },
            ])
            ->orderBy(['rank' => SORT_ASC])
            ->all();

        $pageParams = new AccomPage();
        $pageParams->load(Yii::$app->params);

        return $this->render('index', [
            'models' => $models,
            'pageParams' => $pageParams,
        ]);
    }
}
