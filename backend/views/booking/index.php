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
                'rowOptions' => function($model, $key, $index, $grid){
                    /* @var $model \common\models\Reviews */
                    if(!$model->viewed){
                        return ['class' => 'newRow'];
                    }
                    if ($model->viewed === 1){
                        return ['class' => 'noReadRow'];
                    }
                    return null;
                },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    [
                        'attribute' => 'tour_id',
                        'filter'=> \common\models\Booking::getTourFromFilter(),
                        'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control form-control-sm'],
                        'value' => function ($data){
                            /* @var $data \common\models\Booking */
                            return $data->tour->title;
                        }
                    ],
                    [
                        'attribute' => 'month_id',
                        'format' => 'date',
                        'filter'=> \common\models\Booking::getMonthFromFilter(),
                        'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control form-control-sm'],
                        'value' => function ($data){
                            /* @var $data \common\models\Booking */
                            return $data->month->title;
                        }
                    ],
                    [
                        'attribute' => 'stage_id',
                        'filter'=> \common\models\Booking::getStageFromFilter(),
                        'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control form-control-sm'],
                        'value' => function ($data){
                            /* @var $data \common\models\Booking */
                            if ($data->stage){
                                return 'c '.Yii::$app->formatter->asDate($data->stage->start_date).' по '.Yii::$app->formatter->asDate($data->stage->end_date);
                            }
                            return null;
                        }
                    ],
//                    'places_count_beads',
                    //'places_count_lavender',
//                    'user_places_count',
                    //'total_price',
                    'customer_name',
                    //'customer_phone',
                    'created_at:datetime',
                    [
                        'attribute' => 'confirm',
                        'label' => 'Состояние',
                        'filter'=>[0=>"Не подтвержденные",1=>"Подтвержденные"],
                        'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control form-control-sm'],
                        'headerOptions' => ['width' => 170],
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\Booking */
                            if ($data->confirm){
                                return Html::a('Отменить подтверждение',
                                    ['confirm', 'id' => $data->id, 'confirm' => false],
                                    ['class' => 'btn btn-default col-xs-12']);
                            }
                            return Html::a('Подтвердить',
                                ['confirm', 'id' => $data->id, 'confirm' => true],
                                ['class' => 'btn btn-success col-xs-12']);
                        }
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>

<?php
$css= <<< CSS

.newRow{
    background-color: #ffdcdc!important;    
}
.noReadRow{
    background-color: #fffdce!important;    
}
.reviewText{
    max-height: 200px;
    overflow-y: auto;
}

CSS;

$this->registerCss($css, ["type" => "text/css"], "callBack" );
?>​
