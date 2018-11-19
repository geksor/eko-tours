<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TimetableItem */

$this->title = Yii::t('app', 'Update Timetable Item: {name}', [
    'name' => $model->timetableDay->tour->title.' день '.$model->timetableDay->day_number.': '.Yii::$app->formatter->asTime($model->start_time, 'hh:mm'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Timetable Items'), 'url' => ['index', 'day_id' => $model->timetable_day_id]];
$this->params['breadcrumbs'][] = ['label' => Yii::$app->formatter->asTime($model->start_time, 'hh:mm'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="timetable-item-update">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
