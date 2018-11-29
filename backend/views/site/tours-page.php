<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;


/* @var $this yii\web\View */
/* @var $model \common\models\TouristPage */

$this->title = 'Страница Туры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-params">

    <div class="box box-primary">
        <div class="box-body">

            <?php $form = ActiveForm::begin(); ?>

            <h2>Настройки страницы</h2>

            <?= $form->field($model, 'title') ?>
            <?= $form->field($model, 'meta_title') ?>
            <?= $form->field($model, 'meta_description') ?>


            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
