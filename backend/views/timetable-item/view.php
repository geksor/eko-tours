<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TimetableItem */

$this->title = Yii::$app->formatter->asTime($model->start_time, 'hh:mm');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Timetable Items'), 'url' => ['index', 'day_id' => $model->timetable_day_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="timetable-item-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['index', 'day_id' => $model->timetable_day_id], ['class' => 'btn btn-default']) ?>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'timetable_day_id',
                        'value' => function ($data){
                            /* @var $data \common\models\TimetableItem */
                            return $data->timetableDay->tour->title.' день '.$data->timetableDay->day_number;
                        }
                    ],
                    [
                        'attribute' => 'start_time',
                        'format' => ['time', 'hh:mm']
                    ],
                    [
                        'attribute' => 'end_time',
                        'format' => ['time', 'hh:mm']
                    ],
                    'text:ntext',
                    [
                        'attribute' => 'publish',
                        'label' => 'Состояние',
                        'value' => function ($data){
                            /* @var $data \common\models\Tour */
                            if ($data->publish){
                                return 'Опубликован';
                            }
                            return 'Не опубликован';
                        }
                    ],
                ],
            ]) ?>

        </div>
    </div>

</div>
