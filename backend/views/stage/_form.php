<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Stage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'start_date')->widget(DateTimePicker::className(),[
        'name' => 'dp_1',
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'options' => ['placeholder' => 'Выбор даты...'],
        'convertFormat' => true,
        'value'=> $model->start_date,
        'pluginOptions' => [
            'format' => 'd.M.yyyy',
            'autoclose'=>true,
            'weekStart'=>1, //неделя начинается с понедельника
            'startDate' => $model::getStartDate($model->month_id), //самая ранняя возможная дата
            'todayBtn'=>true, //снизу кнопка "сегодня"
            'minView'=>2,
        ]
    ]) ?>

    <?= $form->field($model, 'end_date')->widget(DateTimePicker::className(),[
        'name' => 'dp_1',
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'options' => ['placeholder' => 'Выбор даты...'],
        'convertFormat' => true,
        'value'=> $model->end_date,
        'pluginOptions' => [
            'format' => 'd.M.yyyy',
            'autoclose'=>true,
            'weekStart'=>1, //неделя начинается с понедельника
            'startDate' => $model::getStartDate($model->month_id), //самая ранняя возможная дата
            'todayBtn'=>true, //снизу кнопка "сегодня"
            'minView'=>2,
        ]
    ]) ?>

    <?= $form->field($model, 'places_beads')->textInput() ?>

    <?= $form->field($model, 'places_lavender')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'publish')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
