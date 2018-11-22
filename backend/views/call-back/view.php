<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\CallBack */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Call Backs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="call-back-view">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>

            <? if ($model->viewed !== 2) {?>
                <p>
                    <?= Html::a('Обработать', ['success', 'id' => $model->id, 'success' => 2], ['class' => 'btn btn-success'])?>
                </p>
            <?}?>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'user_name',
                        'phone',
                        [
                            'attribute' => 'is_consult',
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
//                        'viewed',
                    ],
                ]) ?>

            <?php Pjax::end(); ?>
        </div>
    </div>


</div>
