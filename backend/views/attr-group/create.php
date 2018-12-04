<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AttrGroup */

$this->title = 'Создание группы атрибутов';
$this->params['breadcrumbs'][] = ['label' => 'Группы атрибутов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attr-group-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
