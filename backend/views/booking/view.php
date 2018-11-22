<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Booking */

$this->title = 'Запись ID: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="booking-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['index'], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
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
                    'places_count_beads',
                    'places_count_lavender',
                    'user_places_count',
                    'total_price',
                    'customer_name',
                    'customer_phone',
                ],
            ]) ?>

        </div>
    </div>

</div>
