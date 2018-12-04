<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TimetableDay */

$this->title = $model->tour->title." день $model->day_number";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Расписание'), 'url' => ['index', 'tour_id' => $model->tour_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="timetable-day-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['index', 'tour_id' => $model->tour_id], ['class' => 'btn btn-default']) ?>
                <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Вы уверены что хотите удалить запись?'),
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('События дня', ['timetable-item/index', 'day_id' => $model->id], ['class' => 'btn btn-default']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'tour_id',
                        'value' => function ($data){
                            /* @var $data \common\models\TimetableDay */
                            return $data->tour->title;
                        }
                    ],
                    'day_number',
                ],
            ]) ?>

        </div>
    </div>

</div>
