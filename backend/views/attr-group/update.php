<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AttrGroup */

$this->title = 'Редактирование группы атрибутов: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Группы атрибутов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="attr-group-update">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
