<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Stage */

$this->title = Yii::t('app', 'Create Stage');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stages'), 'url' => ['index', 'month_id' => $model->month_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stage-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
