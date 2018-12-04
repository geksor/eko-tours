<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PriceSection */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Разделы цен', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="price-section-view">

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
                <?= Html::a('Выбрать изображение', ['set-image', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Элементы раздела', ['price-item/index', 'section_id' => $model->id], ['class' => 'btn btn-default']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    [
                        'attribute' => 'image',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\Month */
                            return Html::img($data->getThumbImage(), ['style' => 'max-width: 200px;']);
                        }
                    ],
                    'rank',
                ],
            ]) ?>

        </div>
    </div>

</div>
