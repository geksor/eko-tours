<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Month */

$this->title = Yii::t('app', 'Создание месяца');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Месяца'), 'url' => ['index', 'tour_id' => $model->tour_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="month-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
