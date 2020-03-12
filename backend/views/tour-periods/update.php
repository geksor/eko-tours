<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TourPeriod */

$this->title = 'Редактирование: от '.$model->start.' до '.$model->end;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Периоды'), 'url' => ['index', 'tour_id' => $model->tour_id]];
$this->params['breadcrumbs'][] = ['label' => 'от '.$model->start.' до '.$model->end, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактирование');
?>
<div class="month-update">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
                'rooms' => $rooms
            ]) ?>

        </div>
    </div>

</div>
