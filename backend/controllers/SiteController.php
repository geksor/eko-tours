<?php
namespace backend\controllers;

use backend\models\WebVisitor;
use common\models\AboutPage;
use common\models\AccomPage;
use common\models\CommPage;
use common\models\Contact;
use common\models\HomePage;
use common\models\TimetablePage;
use common\models\TouristPage;
use common\models\ToursPage;
use nox\components\http\userAgent\UserAgentParser;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

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
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [
                            'logout',
                            'index',
                            'contact',
                            'home-page',
                            'comm-page',
                            'timetable-page',
                            'about-page',
                            'tourist-page',
                            'tours-page',
                            'accom-page',
                        ],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $counter_direct = WebVisitor::getStat(WebVisitor::TYPE_DIRECT);
        $counter_inner = WebVisitor::getStat(WebVisitor::TYPE_INNER);
        $counter_ads = WebVisitor::getStat(WebVisitor::TYPE_ADS);
        $counter_search = WebVisitor::getStat(WebVisitor::TYPE_SEARCH);

        $browserStat = WebVisitor::getBrowserStat();
        $labelsChart = [];
        $dataChart = [];
        $tempArr = [];
        if ($browserStat){
            foreach ($browserStat as $item){
                /* @var $item WebVisitor */
                $browser = UserAgentParser::parse($item->user_agent)['browser'];
                if (array_key_exists($browser, $tempArr)){
                    $tempArr[$browser][0] = $tempArr[$browser][0]+$item->visits;
                }else{
                    $tempArr[$browser][0] = $item->visits;
                }
            }
            foreach ($tempArr as $key => $item){
                $labelsChart[] = $key;
                $dataChart[] = $item[0];
            }
        }
//        VarDumper::dump($tempArr,20,true);die;

        return $this->render('index', [
            'counter_direct' => $counter_direct,
            'counter_inner' => $counter_inner,
            'counter_ads' => $counter_ads,
            'counter_search' => $counter_search,
            'labelsChart' => json_encode($labelsChart),
            'dataChart' => json_encode($dataChart),
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionContact()
    {
        $model = new Contact();

        if ($model->load(Yii::$app->params)) {
            if (Yii::$app->request->post()) {
                $model->save(Yii::$app->request->post('Contact'));
                return $this->redirect(['contact']);
            }
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionHomePage()
    {
        $model = new HomePage();

        if ($model->load(Yii::$app->params)) {
            if (Yii::$app->request->post()) {
                $model->save(Yii::$app->request->post('HomePage'));
                return $this->redirect(['home-page']);
            }
        }

        return $this->render('home-page', [
            'model' => $model,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCommPage()
    {
        $model = new CommPage();

        if ($model->load(Yii::$app->params)) {
            if (Yii::$app->request->post()) {
                $model->save(Yii::$app->request->post('CommPage'));
                return $this->redirect(['comm-page']);
            }
        }

        return $this->render('comm-page', [
            'model' => $model,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionTimetablePage()
    {
        $model = new TimetablePage();

        if ($model->load(Yii::$app->params)) {
            if (Yii::$app->request->post()) {
                $model->save(Yii::$app->request->post('TimetablePage'));
                return $this->redirect(['timetable-page']);
            }
        }

        return $this->render('timetable-page', [
            'model' => $model,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionAboutPage()
    {
        $model = new AboutPage();

        if ($model->load(Yii::$app->params)) {
            if (Yii::$app->request->post()) {
                $model->save(Yii::$app->request->post('AboutPage'));
                return $this->redirect(['about-page']);
            }
        }

        return $this->render('about-page', [
            'model' => $model,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionTouristPage()
    {
        $model = new TouristPage();

        if ($model->load(Yii::$app->params)) {
            if (Yii::$app->request->post()) {
                $model->save(Yii::$app->request->post('TouristPage'));
                return $this->redirect(['tourist-page']);
            }
        }

        return $this->render('tourist-page', [
            'model' => $model,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionToursPage()
    {
        $model = new ToursPage();

        if ($model->load(Yii::$app->params)) {
            if (Yii::$app->request->post()) {
                $model->save(Yii::$app->request->post('ToursPage'));
                return $this->redirect(['tours-page']);
            }
        }

        return $this->render('tours-page', [
            'model' => $model,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionAccomPage()
    {
        $model = new AccomPage();

        if ($model->load(Yii::$app->params)) {
            if (Yii::$app->request->post()) {
                $model->save(Yii::$app->request->post('AccomPage'));
                return $this->redirect(['accom-page']);
            }
        }

        return $this->render('accom-page', [
            'model' => $model,
        ]);
    }
}
