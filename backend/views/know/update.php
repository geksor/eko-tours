<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Know */

$this->title = 'Редактирование раздела: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Туристам', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="know-update">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
