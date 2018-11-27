<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;


/* @var $this yii\web\View */
/* @var $model \common\models\AboutPage */

$this->title = 'Страница О нас';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-params">

    <div class="box box-primary">
        <div class="box-body">

            <?php $form = ActiveForm::begin(); ?>

            <h2>Настройки страницы</h2>

            <?= $form->field($model, 'title') ?>
            <?= $form->field($model, 'meta_title') ?>
            <?= $form->field($model, 'meta_description') ?>
            <?= $form->field($model, 'aboutText')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                    'height' => 300,
                    'resize_enabled' => true,
                ],
            ]) ?>

            <h2>Расписание</h2>

            <?= $form->field($model, 'monday') ?>
            <?= $form->field($model, 'tuesday') ?>
            <?= $form->field($model, 'wednesday') ?>
            <?= $form->field($model, 'thursday') ?>
            <?= $form->field($model, 'friday') ?>
            <?= $form->field($model, 'saturday') ?>
            <?= $form->field($model, 'sunday') ?>


            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
