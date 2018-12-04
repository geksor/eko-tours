<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Reviews */

$this->title = "Отзыв от: $model->user_name";
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reviews-view">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>
            <p>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены что хотите удалить запись?',
                        'method' => 'post',
                    ],
                ]) ?>
                <? if ($model->publish) {?>
                    <?= Html::a('Снять с публикации', ['publish', 'id' => $model->id, 'publish' => false], ['class' => 'btn btn-default']) ?>
                <?}else{?>
                    <?= Html::a('Опубликовать', ['publish', 'id' => $model->id, 'publish' => true], ['class' => 'btn btn-default']) ?>
                <?}?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'tour_id',
                        'value' => function ($data){
                            /* @var $data \common\models\Reviews */
                            if ($data->tour_id){
                                return $data->tour->title;
                            }
                                return 'Общий отзыв';
                        }
                    ],
                    'user_name',
                    'phone',
                    'text:ntext',
                    'create_at:datetime',
                    'done_at:datetime',
                    'publish:boolean',
                    'from_widget:boolean',
                    'rank',
                ],
            ]) ?>
            <?php Pjax::end(); ?>
        </div>
    </div>

</div>
