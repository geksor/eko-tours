<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\TourPeriod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="month-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'start')->widget(DateTimePicker::className(), [
        'name'          => 'dp_1',
        'type'          => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'options'       => ['placeholder' => 'Выбор месяца...'],
        'convertFormat' => true,
        'value'         => $model->start,
        'pluginOptions' => [
            'format'    => 'yyyy-MM-dd',
            'autoclose' => true,
            'weekStart' => 1, //неделя начинается с понедельника
            'startDate' => '01.05.2015 00:00', //самая ранняя возможная дата
            'todayBtn'  => true, //снизу кнопка "сегодня"
            'minView'   => 2,
            'startView' => 2,
        ],
    ]) ?>

    <?= $form->field($model, 'end')->widget(DateTimePicker::className(), [
        'name'          => 'dp_1',
        'type'          => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'options'       => ['placeholder' => 'Выбор месяца...'],
        'convertFormat' => true,
        'value'         => $model->end,
        'pluginOptions' => [
            'format'    => 'yyyy-MM-dd',
            'autoclose' => true,
            'weekStart' => 1, //неделя начинается с понедельника
            'startDate' => '01.05.2015 00:00', //самая ранняя возможная дата
            'todayBtn'  => true, //снизу кнопка "сегодня"
            'minView'   => 2,
            'startView' => 2,
        ],
    ]) ?>

    <?= $form->field($model, 'publish')->checkbox() ?>

    <?php
    if($rooms["accoms"]) {
        foreach ($rooms["accoms"] as $key => $row) {
            echo '<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">'.$row.'</h3>
            </div>
            <div class="box-body">
';
            if ($rooms["rooms"][$key]) {
                foreach ($rooms["rooms"][$key] as $rowRoom) {
                    echo '
              <div class="form-group field-tour-title col-xs-3">
              <label class="control-label" for="room-'.$rowRoom["id"].'">'.$rowRoom["title"].'</label>
              <input type="text" id="room-'.$rowRoom["id"].'" class="form-control" name="room['.$rowRoom["id"].']" value="'.$rowRoom["price"].'" maxlength="255" placeholder="Введите сумму в рублях"> 
              <div class="help-block"></div>
              </div>';
                }
            } else {
                echo 'В данном гостевом доме нет комнат.';
            }

            echo '
            </div>
            <!-- /.box-body -->
          </div>';
        }
    }
    ?>

  <div class="form-group">
      <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
  </div>

    <?php ActiveForm::end(); ?>

</div>
