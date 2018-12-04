<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PriceItem */

$this->title = 'Редактирование: '.$model->text;
$this->params['breadcrumbs'][] = ['label' => 'Price Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->text, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="price-item-update">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
