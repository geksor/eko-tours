<?php
namespace frontend\widgets;

use common\models\Reviews;
use yii\base\Widget;

class ReviewsFormWidget extends Widget
{
    public function run()
    {
        $model = new Reviews();

        return $this->render('reviews-form-widget', [
            'model' => $model,
        ]);
    }
}