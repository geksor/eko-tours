<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\TimetableItem */
/* @var $form yii\widgets\ActiveForm */
$model->start_time = null;
$model->end_time = null;
?>

<div class="timetable-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'start_time')->widget(DateTimePicker::className(),[
        'name' => 'dp_1',
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'options' => ['placeholder' => 'Выбор времени...'],
        'convertFormat' => true,
        'value'=> null,
        'pluginOptions' => [
            'format' => 'hh:m',
            'autoclose'=>true,
            'weekStart'=>1, //неделя начинается с понедельника
            'startDate' => '01.05.2015 00:00', //самая ранняя возможная дата
            'todayBtn'=>false, //снизу кнопка "сегодня"
            'minView'=>0,
            'maxView'=>1,
            'startView'=>1,

        ]
    ]) ?>

    <?= $form->field($model, 'end_time')->widget(DateTimePicker::className(),[
        'name' => 'dp_1',
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'options' => ['placeholder' => 'Выбор времени...'],
        'convertFormat' => true,
        'value'=> null,
        'pluginOptions' => [
            'format' => 'hh:m',
            'autoclose'=>true,
            'weekStart'=>1, //неделя начинается с понедельника
            'startDate' => '01.05.2015 00:00', //самая ранняя возможная дата
            'todayBtn'=>false, //снизу кнопка "сегодня"
            'minView'=>0,
            'maxView'=>1,
            'startView'=>1,

        ]
    ]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'publish')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
