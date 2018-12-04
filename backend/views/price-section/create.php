<?php


/* @var $this yii\web\View */
/* @var $model common\models\PriceSection */

$this->title = 'Создание раздела';
$this->params['breadcrumbs'][] = ['label' => 'Разделы цен', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-section-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
