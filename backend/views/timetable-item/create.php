<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TimetableItem */

$this->title = Yii::t('app', 'Create Timetable Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Timetable Items'), 'url' => ['index', 'day_id' => $model->timetable_day_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-item-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
