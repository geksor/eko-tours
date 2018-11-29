<?php
namespace frontend\widgets;

use common\models\Tour;
use yii\base\Widget;

class ToursHomeWidget extends Widget
{
    public function run()
    {
        $models = Tour::find()->where(['publish' => 1, 'deleted' => 0])->orderBy(['rank' => SORT_ASC])->all();

        return $this->render('tours-home-widget', [
            'models' => $models,
        ]);
    }
}