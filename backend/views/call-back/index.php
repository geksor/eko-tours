<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CallBackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Call Backs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-back-index">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'rowOptions' => function($model, $key, $index, $grid){
                    if(!$model->viewed){
                        return ['class' => 'newRow'];
                    }
                    if ($model->viewed === 1){
                        return ['class' => 'noReadRow'];
                    }
                    return null;
                },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'user_name',
                    'phone',
                    [
                        'attribute' => 'is_consult',
                        'filter'=>[0=>"Обратный звонок",1=>"Консультация"],
                        'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control form-control-sm'],
                        'headerOptions' => ['width' => 170],
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\CallBack */
                            if ($data->is_consult){
                                return 'Консультация';
                            }
                            return 'Обратный звонок';
                        }
                    ],
                    'created_at:datetime',
                    'done_at:datetime',
                    [
                        'attribute' => 'viewed',
                        'label' => 'Состояние',
                        'filter'=>[0=>"Не обработанные",2=>"Обработанные"],
                        'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control form-control-sm'],
                        'headerOptions' => ['width' => '170'],
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\CallBack */
                            if (!$data->viewed || $data->viewed === 1){
                                return Html::a('Обработать',
                                    ['success', 'id' => $data->id, 'success' => 2],
                                    ['class' => 'btn btn-success col-xs-12']);
                            }
                            return 'Обработано';
                        }
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
