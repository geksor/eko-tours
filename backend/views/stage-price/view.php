<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StagePrice */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Потоки', 'url' => ['index', 'stageId' => $model->stage_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="stage-price-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['index', 'stage_id' => $model->stage_id], ['class' => 'btn btn-default']) ?>
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
                        'attribute' => 'accom_id',
                        'value' => function ($data){
                            /* @var $data \common\models\StagePrice */
                            return $data->accom->title;
                        }
                    ],
                    'title',
                    [
                        'attribute' => 'image',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\StagePrice */
                            if ($data->getImageIsSet('image')){
                                return '<div class="row imageRow">'
                                    .'<div class="col-xs-5 col-md-3 col-lg-1">'
                                    .Html::img($data->getThumbImage('image'), ['style' => 'max-width: 100%;'])
                                    .'</div>'
                                    .'<div class="col-xs-3">'
                                    .Html::a('Изменить', ['set-image', 'id' => $data->id], ['class' => 'btn btn-warning'])
                                    .'</div>'
                                    .'</div>';
                            }
                            return Html::a('Установить', ['set-image', 'id' => $data->id], ['class' => 'btn btn-success']);
                        }
                    ],

                    'description:raw',
                    'place_count',
                    'price',
                    'rank',
                    'publish:boolean',
                ],
            ]) ?>

        </div>
    </div>

</div>
