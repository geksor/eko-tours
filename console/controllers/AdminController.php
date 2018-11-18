<?php
namespace console\controllers;

use common\models\User;
use yii\console\Controller;


class AdminController extends Controller
{
    public function actionCreate()
    {
        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@example.ru';
        $user->setPassword(123456);
        $user->generateAuthKey();

        $user->save();
    }
}