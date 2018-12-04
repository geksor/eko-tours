<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Attribute */

$this->title = 'Создание атрибута';
$this->params['breadcrumbs'][] = ['label' => 'Атрибуты номеров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
