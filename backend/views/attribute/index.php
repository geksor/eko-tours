<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\AttributeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Атрибуты номеров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-index">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Создать атрибут', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'title',
                    [
                        'attribute' => 'image',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\Attribute */
                            return Html::img($data->getThumbImage(), ['style' => 'max-width: 60px;']);
                        }
                    ],
                    [
                        'attribute' => 'rank',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\Attribute */
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
                        url: "/admin/attribute/rank",
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
