<?php

use kartik\widgets\Select2;
use kartik\widgets\SwitchInput;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StagePrice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stage-price-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'accom_id')->widget(Select2::className(), [
        'hideSearch' => true,
        'language' => 'ru',
        'data' => $model::getAccomListToForm(),
        'options' => ['placeholder' => 'Выберите гостевой дом...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
            'height' => 300,
            'resize_enabled' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'place_count')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

<!--    --><?//= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'rank')->textInput() ?>

    <?= $form->field($model, 'publish')->widget(SwitchInput::className(), []) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Отменить', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
