<?php

/* @var $this yii\web\View */
/* @var $model common\models\PriceSection */

$this->title = 'Update Price Section: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Price Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="price-section-update">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
