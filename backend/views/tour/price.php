<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */
/* @var $priceSections */

$this->title = 'Настройка раздела цены: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Настройка раздела цены';
?>
<div class="category-atribute">

    <div class="box box-primary">
        <div class="box-body">
            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
                <? if ($model->tourPrice) {?>
                    <?= Html::a('Заполнить цены', ['price-item', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?}?>
            </p>

            <?= $this->render('_form-price', [
                'model' => $model,
                'priceSections' => $priceSections,
            ]) ?>

        </div>
    </div>

</div>
