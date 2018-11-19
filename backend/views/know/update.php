<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Know */

$this->title = 'Update Know: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Knows', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="know-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
