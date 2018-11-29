<?php
namespace frontend\widgets;

use common\models\Accom;
use yii\base\Widget;

class HotelHomeWidget extends Widget
{
    public function run()
    {
        $models = Accom::find()->where(['publish' => 1])->orderBy(['rank' => SORT_ASC])->all();

        return $this->render('hotel-home-widget', [
            'models' => $models,
        ]);
    }
}