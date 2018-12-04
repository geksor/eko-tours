<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Attr */

$this->title = 'Создание атрибута';
$this->params['breadcrumbs'][] = ['label' => 'Атрибуты туров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attr-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
