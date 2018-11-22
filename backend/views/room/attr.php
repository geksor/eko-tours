<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Room */
/* @var $attributes */

$this->title = 'Настройка атрибутов: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Настройка атрибутов';
?>
<div class="room-attribute">

    <div class="box box-primary">
        <div class="box-body">
            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
            </p>

            <?= $this->render('_form-attr', [
                'model' => $model,
                'attributes' => $attributes,
            ]) ?>

        </div>
    </div>

</div>
