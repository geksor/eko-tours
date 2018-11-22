<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CallBack */

$this->title = 'Update Call Back: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Call Backs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="call-back-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
