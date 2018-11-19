<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Accom */

$this->title = 'Update Accom: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Accoms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accom-update">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
