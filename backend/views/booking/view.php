<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Booking */

$this->title = 'Запись ID: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Запись', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="booking-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['index'], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены что хотите удалить запись?',
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
                            if ($data->stage){
                                return 'c '.Yii::$app->formatter->asDate($data->stage->start_date).' по '.Yii::$app->formatter->asDate($data->stage->end_date);
                            }
                            return null;
                        }
                    ],
                    'created_at:datetime',
                    'done_at:datetime',
                    'user_places_count',
                    'total_price:decimal',
                    'customer_name',
                    'customer_phone',
                    'confirm:boolean'
                ],
            ]) ?>

        </div>
    </div>

</div>
