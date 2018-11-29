<?php
namespace frontend\widgets;

use common\models\Reviews;
use yii\base\Widget;

class ReviewsHomeWidget extends Widget
{
    public function run()
    {
        $models = Reviews::find()->where(['publish' => 1, 'from_widget' => 1])->orderBy(['rank' => SORT_ASC])->all();

        return $this->render('reviews-home-widget', [
            'models' => $models,
        ]);
    }
}