<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\KnowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Knows';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="know-index">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Create Know', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'title',
//                    'text:ntext',
//                    'image_count',
                    [
                        'attribute' => 'rank',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\Know */
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
