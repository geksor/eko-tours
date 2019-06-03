<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model \common\models\Contact */

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-params">

    <div class="box box-primary">
        <div class="box-body">

            <?php $form = ActiveForm::begin(); ?>

<!--            <h2>Настройки страницы</h2>-->
<!---->
<!--            --><?//= $form->field($model, 'title') ?>
<!--            --><?//= $form->field($model, 'meta_title') ?>
<!--            --><?//= $form->field($model, 'meta_description') ?>

            <h2>Контакты</h2>

            <?= $form->field($model, 'address') ?>
            <?= $form->field($model, 'phone') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'mapScript') ?>

            <h2>Реквизиты</h2>

            <?= $form->field($model, 'company_name') ?>
            <?= $form->field($model, 'corpAddress') ?>
            <?= $form->field($model, 'inn') ?>
            <?= $form->field($model, 'kpp') ?>
            <?= $form->field($model, 'ogrn') ?>
            <?= $form->field($model, 'field') ?>

            <h2>Соцсети</h2>

            <?= $form->field($model, 'insta') ?>
            <?= $form->field($model, 'vk') ?>

            <h2>Прочие настройки</h2>

            <?= $form->field($model, 'chatId') ?>


            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
