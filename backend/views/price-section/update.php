<?php

/* @var $this yii\web\View */
/* @var $model common\models\PriceSection */

$this->title = 'Редактирование: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Раздел цен', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
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
