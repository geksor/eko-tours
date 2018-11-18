<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Stage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stages'), 'url' => ['index', 'month_id' => $model->month_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="stage-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
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

                    'places_beads',
                    'places_lavender',
                    'price',
                    'publish',
                ],
            ]) ?>

        </div>
    </div>

</div>
