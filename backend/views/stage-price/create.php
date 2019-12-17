<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\StagePrice */

$this->title = 'Создание цены';
$this->params['breadcrumbs'][] = ['label' => 'Цены', 'url' => ['index', 'stageId' => $model->stage_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stage-price-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
