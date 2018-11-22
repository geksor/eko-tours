<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Room */
/* @var $form yii\widgets\ActiveForm */
/* @var $attributes */
?>

<div class="room-form-attr">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'categoryType_id')->textInput() ?>

    <?= $form->field($model, 'attrs')->dropDownList($attributes, [
        'multiple' => true,
        'size' => 15,
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
