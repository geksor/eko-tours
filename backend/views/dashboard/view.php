<?php

use akiraz2\stat\models\WebVisitor;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model \akiraz2\stat\models\WebVisitor */
/* @var $searchModel \backend\models\WebVisitorViewSearch */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Панель статистики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <div class="box box-primary">
        <div class="box-body">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'cookie_id',
                    [
                        'attribute' => 'source',
                        'value' => function ($model) {
                            /* @var $model WebVisitor */
                            return $model->getSource();
                        },
                    ],
                    'ip_address',
                    'url',
                    'referrer',
//                    'user_agent',
                    'created_at',

                ],
            ]) ?>
        </div>
    </div>

</div>
