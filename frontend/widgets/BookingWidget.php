<?php
namespace frontend\widgets;

use common\models\Booking;
use yii\base\Widget;

class BookingWidget extends Widget
{
    public function run()
    {
        $model = new Booking();

        return $this->render('booking-widget', [
            'model' => $model,
        ]);
    }
}