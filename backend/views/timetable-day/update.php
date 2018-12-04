<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TimetableDay */

$this->title = Yii::t('app', 'Редактирование: {name}', [
    'name' => $model->tour->title.' день '.$model->day_number,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Расписание'), 'url' => ['index', 'tour_id' => $model->tour_id]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактирование');
?>
<div class="timetable-day-update">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
