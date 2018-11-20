<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ReviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-index">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Create Reviews', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'rowOptions' => function($model, $key, $index, $grid){
                    /* @var $model \common\models\Reviews */
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

//                    'id',
                    [
                        'attribute' => 'tour_id',
                        'filter' => false,
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
//                    'text:ntext',
                    'create_at:datetime',
                    'done_at:datetime',
                    'rank',
                    'publish',
                    //'from_widget',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>

<?php
$css= <<< CSS

.newRow{
    background-color: #ffdcdc!important;    
}
.noReadRow{
    background-color: #fffdce!important;    
}
.reviewText{
    max-height: 200px;
    overflow-y: auto;
}

CSS;

$this->registerCss($css, ["type" => "text/css"], "callBack" );
?>​
