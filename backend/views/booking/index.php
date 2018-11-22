<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\BookingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bookings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-index">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Create Booking', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    [
                        'attribute' => 'tour_id',
                        'value' => function ($data){
                            /* @var $data \common\models\Booking */
                            return $data->tour->title;
                        }
                    ],
                    [
                        'attribute' => 'month_id',
                        'format' => 'date',
                        'value' => function ($data){
                            /* @var $data \common\models\Booking */
                            return $data->month->title;
                        }
                    ],
                    [
                        'attribute' => 'stage_id',
                        'value' => function ($data){
                            /* @var $data \common\models\Booking */
                            return 'c '.Yii::$app->formatter->asDate($data->stage->start_date).' по '.Yii::$app->formatter->asDate($data->stage->end_date);
                        }
                    ],
//                    'places_count_beads',
                    //'places_count_lavender',
//                    'user_places_count',
                    //'total_price',
                    'customer_name',
                    //'customer_phone',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
