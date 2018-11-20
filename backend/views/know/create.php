<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Know */

$this->title = 'Create Know';
$this->params['breadcrumbs'][] = ['label' => 'Knows', 'url' => ['index']];
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
