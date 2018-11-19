<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\AccomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accoms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accom-index">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Create Accom', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'title',
//                    'description:ntext',
//                    'video_link',
                    [
                        'attribute' => 'rank',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\Accom */
                            return Html::input('number', 'rank' ,$data->rank, ['class' => 'form-control', 'id' => $data->id]);
                        }

                    ],
                    [
                        'attribute' => 'publish',
                        'label' => 'Состояние',
                        'filter'=>[0=>"Не опубликованные",1=>"Опубликованные"],
                        'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control form-control-sm'],
                        'headerOptions' => ['width' => '170'],
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\Accom */
                            if ($data->publish){
                                return Html::a('Снять с публикации',
                                    ['publish', 'id' => $data->id, 'publish' => false],
                                    ['class' => 'btn btn-default col-xs-12']);
                            }
                            return Html::a('Опубликовать',
                                ['publish', 'id' => $data->id, 'publish' => true],
                                ['class' => 'btn btn-success col-xs-12']);
                        }
                    ],
                    //'is_gallery',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?
            $js = <<< JS
            $('[name = rank]').keypress(function(e){
                if(e.keyCode==13){
                    $.ajax({
                        type: "GET",
                        url: "/admin/accom/rank",
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
