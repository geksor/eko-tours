<?php
/**
 * @project: yii2-stat
 * @description Multi web stat and analytics module
 * @author: akiraz2
 * @license: MIT
 * @copyright (c) 2018.
 */

namespace backend\controllers;

use akiraz2\stat\Models\KslStatistic;
use backend\models\WebVisitor;
use backend\models\WebVisitorSearch;
use backend\models\WebVisitorViewSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DashboardController extends Controller
{
    /**
     * @return bool
     */
    public function actionForms()
    {

        $request = Yii::$app->request->post();
        $count_model = $request;

        $session = Yii::$app->session;

        //Валидация формы входа
        if (isset($count_model['enter'])) {
            $validate = $this->validatePassword($request, $session);
            if (!$validate) return false;
        }

        /*
         * Формы выбора параметров вывода статистики
         */
        $condition = [];
        $stat_ip = false;

        $model = new KslStatistic();


        //Сброс фильтров
        if (isset($count_model['reset'])) {
            $condition = [];
        }

        if (isset($count_model['date_ip'])) {
            $time = strtotime($count_model['date_ip']);
            $time_max = $time + 86400;
            $condition = ["date_ip", $time, $time_max];
        }


        //За период
        if (isset($count_model['period'])) {

            if (!empty($count_model['start_time'])) {
                $timeStartUnix = strtotime($count_model['start_time']);
            } else {
                $sec_todey = time() - strtotime('today'); //сколько секунд прошло с начала дня
                $timeStartUnix = time() - $sec_todey;
            }

            //Если не передана дата конца - ставим текущую
            if (empty($count_model['stop_time'])) {
                $timeStopUnix = time();
            } else {
                $timeStopUnix = strtotime($count_model['stop_time']);
            }

            $timeStopUnix += 86400; //целый день (до конца суток)
            $condition = ["date_ip", $timeStartUnix, $timeStopUnix];
        }


        //По IP
        if (isset($count_model['search_ip'])) {

            $condition = ["ip" => $count_model['ip']];
            $stat_ip = true;

            if (!$count_model['ip']) $session->setFlash('danger', 'Укажите IP для поиска');
        }


        //Добавить в черный список
        if (isset($count_model['add_black_list'])) {

            if (!$count_model['ip']) {

                $session->setFlash('danger', 'Укажите IP для добавления в черный список');

            } else {

                if (!isset($count_model['comment'])) $count_model['comment'] = '';
                $model->set_black_list($count_model['ip'], $count_model['comment']);
            }
        }

        //Удалить из черного списка
        if (isset($count_model['del_black_list'])) {

            if (!$count_model['ip']) {
                $session->setFlash('danger', 'Укажите IP для удаления из черного списка');

            } else {
                $model->remove_black_list($count_model['ip']);
            }
        }

        //Удалить старые данные
        if (isset($count_model['del_old'])) {
            $model->remove_old();
        }

        $view = $this->actionIndex($condition, $stat_ip);
        echo $view;
    }

    /**
     * Проверка введенного пароля
     *
     * @param array $request
     * @param yii\web\Session $session
     * @return bool
     */
    public function validatePassword($request, $session)
    {
        $password_config = KslStatistic::getParameters()['password'];
        $password_enter = $request['password'];

        if ($password_config == $password_enter) {
            $session->set('ksl-statistics', $password_config);
            $this->redirect(Yii::$app->urlManager->createUrl('statistics/stat/index'))->send();

        } else {
            $session->setFlash('danger', 'Неверный пароль');
            return false;
        }
        return true;
    }

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
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new WebVisitorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $counter_direct = WebVisitor::getStat(WebVisitor::TYPE_DIRECT);
        $counter_inner = WebVisitor::getStat(WebVisitor::TYPE_INNER);
        $counter_ads = WebVisitor::getStat(WebVisitor::TYPE_ADS);
        $counter_search = WebVisitor::getStat(WebVisitor::TYPE_SEARCH);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'counter_direct' => $counter_direct,
            'counter_inner' => $counter_inner,
            'counter_ads' => $counter_ads,
            'counter_search' => $counter_search
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $searchModel = new WebVisitorViewSearch();
        if ($model){
            $searchModel->cookie_id = $model->cookie_id;
            $searchModel->source = 1;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return WebVisitor|null
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WebVisitor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WebVisitor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
