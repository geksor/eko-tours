<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Know */

$this->title = 'Создание раздела';
$this->params['breadcrumbs'][] = ['label' => 'Туристам', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="know-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
