<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Туры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tour-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['index'], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены что хотите удалить запись?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Создать новый тур', ['create'], ['class' => 'btn btn-warning']) ?>
                <?= Html::a('Месяца', ['month/index', 'tour_id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Расписание', ['timetable-day/index', 'tour_id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Раздел цены', ['price', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Раздел важно знать', ['knows', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Раздел Размещение', ['accoms', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
<!--                --><?//= Html::a('Выбор атрибутов', ['attrs', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Выбор разделов', ['categories', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Периоды и цены', ['tour-periods/index', 'tour_id' => $model->id], ['class' => 'btn btn-default']) ?>

            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'title_add',
                    'meta_title',
                    'meta_description:ntext',
                    'min_price:decimal',
                    'max_count',
                    'alias',
                    'short_description',
                    [
                        'attribute' => 'description',
                        'format' => 'html'
                    ],
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
                    'hot:boolean',
                    'free_field',
                    'show_on_home:boolean'
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
