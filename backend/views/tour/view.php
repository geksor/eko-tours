<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tour-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['index'], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Месяца', ['month/index', 'tour_id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Расписание', ['timetable-day/index', 'tour_id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Раздел цены', ['price', 'id' => $model->id], ['class' => 'btn btn-default']) ?>

            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'min_price:decimal',
                    'alias',
                    'short_description',
                    [
                        'attribute' => 'description',
                        'format' => 'html'
                    ],
                    'meta_title',
                    'meta_description:ntext',
                    'rank',
                    [
                        'attribute' => 'publish',
                        'label' => 'Состояние',
                        'value' => function ($data){
                            /* @var $data \common\models\Tour */
                            if ($data->publish){
                                return 'Опубликован';
                            }
                            return 'Не опубликован';
                        }
                    ],
                    [
                        'attribute' => 'hot',
                        'label' => 'Горящий тур',
                        'value' => function ($data){
                            /* @var $data \common\models\Tour */
                            if ($data->hot){
                                return 'Да';
                            }
                            return 'Нет';
                        }
                    ],
                ],
            ]) ?>

        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Изображения тура</h3>
        </div>
        <div class="box-body">
            <? if ($model->isNewRecord) {
                echo 'Нельзя загружать изображения до создания галлереи';
            } else {
                echo GalleryManager::widget(
                    [
                        'model' => $model,
                        'behaviorName' => 'galleryBehavior',
                        'apiRoute' => 'tour/galleryApi'
                    ]
                );
            }?>
        </div>
    </div>

</div>
