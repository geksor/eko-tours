<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TimetableDay */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="timetable-day-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'day_number')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
