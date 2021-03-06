<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PriceItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $title */

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-item-index">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['price-section/view', 'id' => $searchModel->price_section_id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Создать элемент', ['create', 'section_id' => $searchModel->price_section_id], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'text:ntext',
                    [
                        'attribute' => 'rank',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\PriceSection */
                            return Html::input('number', 'rank' ,$data->rank, ['class' => 'form-control', 'id' => $data->id]);
                        }

                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?
            $js = <<< JS
            $('[name = rank]').keypress(function(e){
                if(e.keyCode==13){
                    $.ajax({
                        type: "GET",
                        url: "/admin/price-item/rank",
                        data: 'id='+ $(this).attr('id') +'&rank='+ $(this).val(),
                    })
                }
            });
JS;

            $this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
