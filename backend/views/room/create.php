<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Room */

$this->title = 'Создание номера';
$this->params['breadcrumbs'][] = ['label' => 'Номера', 'url' => ['index', 'accom_id' => $model->accom_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
