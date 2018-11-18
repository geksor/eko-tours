<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\ImageUpload */
/* @var $imageFrom */
/* @var $title */
/* @var $width */
/* @var $height */

$this->title = 'Выбор Изображения: ' . $title;

?>
<div class="personal-set-photo">

    <div class="box box-primary">
        <div class="box-body">
            <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', Yii::$app->request->referrer, ['class' => 'btn btn-default']) ?>

            <?= $this->render('_form-photo', [
                'model' => $model,
                'width' => $width,
                'height' => $height,
            ]) ?>

        </div>
    </div>

</div>
