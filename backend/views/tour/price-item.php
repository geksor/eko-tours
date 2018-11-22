<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PriceSection */
/* @var $priceSections */

$this->title = 'Заполнение значений цены: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => 'Настройка раздела цены: ' . $model->title, 'url' => ['price', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Заполнение значений цены';
?>
<div class="category-atribute">

    <div class="box box-primary">
        <div class="box-body">
            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['price', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
            </p>

            <? foreach ($priceSections as $priceSection) {/* @var $priceSection \common\models\PriceSection */?>
                <? if ($priceSection->priceItems) {?>
                    <h2><?= $priceSection->title ?></h2>
                    <? foreach ($priceSection->priceItems as $priceItem) {?>
                        <div class="row">
                            <p class="col-sm-4">
                                <?= $priceItem->text?>
                            </p>
                            <p class="col-sm-4">
                                <?= Html::input(
                                        'text',
                                        'value',
                                        $priceItem->getValue($model->id),
                                        [
                                            'class' => 'form-control',
                                            'id' => $priceItem->id,
                                            'data-tour_id' => $model->id,
                                        ])?>
                            </p>
                        </div>
                    <?}?>
                <?}?>
            <?}?>

        </div>
    </div>

</div>

<?
$js = <<< JS
            $('[name = value]').keypress(function(e){
                if(e.keyCode==13){
                    $.ajax({
                        type: "GET",
                        url: "/admin/tour/price-value",
                        data: 'id='+ $(this).attr('id') +'&value='+ $(this).val() +'&tour_id='+ $(this).data('tour_id'),
                    })
                }
            });
JS;

$this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
?>
