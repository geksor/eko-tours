<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */

$this->title = 'Выбор раздела для: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Туры', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Выбор раздела';
?>

<div class="tour">

    <div class="box box-primary">
        <div class="box-body">
            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
            </p>

            <?= $this->render('_category-form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
