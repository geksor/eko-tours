<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Booking */

$this->title = 'Создание записи';
$this->params['breadcrumbs'][] = ['label' => 'Запись', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
