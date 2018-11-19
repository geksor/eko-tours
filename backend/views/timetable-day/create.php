<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TimetableDay */

$this->title = Yii::t('app', 'Create Timetable Day').' для '.$model->tour->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Timetable Days'), 'url' => ['index', 'tour_id' => $model->tour_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-day-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
