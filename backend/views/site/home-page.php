<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;


/* @var $this yii\web\View */
/* @var $model \common\models\HomePage */

$this->title = 'Домашняя страница';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="home-params">

    <div class="box box-primary">
        <div class="box-body">

            <?php $form = ActiveForm::begin(); ?>

            <h2>Настройки страницы</h2>

            <?= $form->field($model, 'title') ?>
            <?= $form->field($model, 'meta_title') ?>
            <?= $form->field($model, 'meta_description') ?>

            <h2>Шапка страницы</h2>

            <?= $form->field($model, 'headerTitle') ?>
            <?= $form->field($model, 'item_1') ?>
            <?= $form->field($model, 'item_2') ?>
            <?= $form->field($model, 'item_3') ?>

            <h2>О нас на главной</h2>

            <?= $form->field($model, 'text')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                    'height' => 300,
                    'resize_enabled' => true,
                ],
            ]) ?>
            <?= $form->field($model, 'gallery_id')->dropDownList($model::getGalleryDropDown()) ?>
            <?= $form->field($model, 'rightBlock_title') ?>
            <?= $form->field($model, 'rightBlock_text')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                    'height' => 300,
                    'resize_enabled' => true,
                ],
            ]) ?>

            <h2>Прочие настройки</h2>

            <?= $form->field($model, 'instagram') ?>


            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
