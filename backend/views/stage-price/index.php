<?php

use kartik\widgets\SwitchInput;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\StagePriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $title */

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stage-price-index">

    <?= \common\widgets\Alert::widget() ?>
    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['stage/view', 'id' => $searchModel->stage_id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Создать запись', ['create', 'stage_id' => $searchModel->stage_id], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'title',
                    [
                        'attribute' => 'rank',
                        'headerOptions' => ['width' => 130],
                        'contentOptions'=>['style'=>'min-width: 130px;'],
                        'format' => 'raw',
                        'content' => function ($data){
                            /* @var $data \common\models\StagePrice */
                            return "<div class='input-group'>" . Html::activeInput('number', $data, 'rank', ['class' => 'form-control', 'data-id' => $data->id, 'id' => "rank_$data->id"]) .
                                "<span class='input-group-btn'>" . Html::button('<span class="glyphicon glyphicon-ok"></span>', ['class'=>'btn btn-primary rankSuccess', 'data-input'=>"#rank_$data->id"]) . "</span></div>";
                        }
                    ],
                    [
                        'attribute' => 'publish',
                        'filter'=>[0=>"Не опубликованные",1=>"Опубликованные"],
                        'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control form-control-sm'],
                        'headerOptions' => ['width' => 100],
                        'format' => 'raw',
                        'value' => function ($data) {
                            /* @var $data \common\models\StagePrice */
                            $urlPublish = Url::to(['publish']);
                            return SwitchInput::widget([
                                'name' => "publish_$data->id",
                                'value' => $data->publish,
                                'class' => 'col-center',
                                'pluginOptions' => [
                                    'onColor' => 'success',
                                    'offColor' => 'danger',
                                    'onText' => '<i class="glyphicon glyphicon-ok"></i>',
                                    'offText' => '<i class="glyphicon glyphicon-remove"></i>',
                                ],
                                'options' => [
                                    'data-id' => $data->id,
                                ],
                                'pluginEvents' => [
                                    'switchChange.bootstrapSwitch' => "function() {
                                                                                            $.ajax({
                                                                                            type: 'GET',
                                                                                            url: '$urlPublish',
                                                                                            data: 'id='+ $(this).data('id') + '&publish=' + Number($(this).prop('checked')),
                                                                                        }) }"
                                ]
                            ]);
                        }
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
$urlRank = Url::to(['rank']);
$js = <<< JS
    $('.rankSuccess').on('click', function(){
        var inputRank = $($(this).data('input'));
        var btn = $(this);
        $.ajax({
            type: "GET",
            url: "$urlRank",
            data: 'id='+ inputRank.data('id') +'&rank='+ inputRank.val(),
            success: function(data) {
              if (data === 'success'){
                  btn.removeClass('btn-primary').addClass('btn-success').blur();
                  setTimeout(function() {
                    btn.removeClass('btn-success').addClass('btn-primary');
                  }, 5000)
              } else {
                  btn.blur();
              } 
            }
        })
    });
JS;
$this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
