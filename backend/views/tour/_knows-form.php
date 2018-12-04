<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tour-knows-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'selectedTourKnow')->dropDownList($model::getKnowsFromDropDown(), [
        'multiple' => true,
        'size' => 20,
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
