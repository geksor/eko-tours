<?php

use kartik\widgets\Select2;
use yii\helpers\Html;
use kartik\form\ActiveForm;;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */
/* @var $form kartik\form\ActiveForm */
?>

<div class="tour-attr-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'selectCat')->widget(Select2::classname(), [
        'data' => $model->catForList,
        'options' => ['placeholder' => 'Выбрать раздел ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true,
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Отменить', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
