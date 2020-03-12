<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model common\models\Accom */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Размещение', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="accom-view">

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
                <?= Html::a('Выбрать основную картинку', ['set-image', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Гостевые номера', ['room/index', 'accom_id' => $model->id], ['class' => 'btn btn-default']) ?>

            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'description:html',
                    'video_link',
                    'rank',
                    [
                        'attribute' => 'publish',
                        'label' => 'Состояние',
                        'value' => function ($data){
                            /* @var $data \common\models\Accom */
                            if ($data->publish){
                                return 'Опубликован';
                            }
                            return 'Не опубликован';
                        }
                    ],
                    [
                        'attribute' => 'is_gallery',
                        'label' => 'В виде галлереи',
                        'value' => function ($data){
                            /* @var $data \common\models\Accom */
                            if ($data->is_gallery){
                                return 'Да';
                            }
                            return 'Нет';
                        }
                    ],
                    [
                        'attribute' => 'image',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\Accom */
                            return Html::img($data->getThumbImage(), ['style' => 'max-width: 200px;']);
                        }
                    ],
                ],
            ]) ?>

        </div>
    </div>

    <? if ($model->is_gallery) {?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Изображения гостевого дома</h3>
            </div>
            <div class="box-body">
                <? if ($model->isNewRecord) {
                    echo 'Нельзя загружать изображения до создания галлереи';
                } else {
                    echo GalleryManager::widget(
                        [
                            'model' => $model,
                            'behaviorName' => 'galleryBehavior',
                            'apiRoute' => 'accom/galleryApi'
                        ]
                    );
                }?>
            </div>
        </div>
    <?}?>

</div>
