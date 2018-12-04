<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Stage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Заезды'), 'url' => ['index', 'month_id' => $model->month_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="stage-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['index', 'month_id' => $model->month_id], ['class' => 'btn btn-default']) ?>
                <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Вы уверены что хотите удалить запись?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'month_id',
                        'format' => ['date', 'php:M Y'],
                        'value' => function ($data){
                            /* @var $data \common\models\Stage */
                            return $data->month->title;
                        }
                    ],
                    [
                        'attribute' => 'start_date',
                        'format' => ['date', 'dd.M.yyyy'],
                    ],
                    [
                        'attribute' => 'end_date',
                        'format' => ['date', 'dd.M.yyyy'],
                    ],

                    'places',
                    'price:decimal',
                    'publish',
                ],
            ]) ?>

        </div>
    </div>

</div>
