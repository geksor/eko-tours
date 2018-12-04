<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Stage */

$this->title = Yii::t('app', 'Ркдактирование изаезда: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Заезды'), 'url' => ['index', 'month_id' => $model->month_id]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактирование');
?>
<div class="stage-update">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
