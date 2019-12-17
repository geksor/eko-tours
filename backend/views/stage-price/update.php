<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StagePrice */

$this->title = "Редактирование цены: $model->title";
$this->params['breadcrumbs'][] = ['label' => 'Потоки', 'url' => ['index', 'stageId' => $model->stage_id]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="stage-price-update">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
