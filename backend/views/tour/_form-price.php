<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PriceSection */
/* @var $form yii\widgets\ActiveForm */
/* @var $priceSections */
?>

<div class="category-form-attr">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'categoryType_id')->textInput() ?>

    <?= $form->field($model, 'tourPrice')->dropDownList($priceSections, [
        'multiple' => true,
        'size' => 15,
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
