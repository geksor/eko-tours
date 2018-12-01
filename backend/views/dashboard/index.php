<?php
/**
 * Copyright (c) 2018
 * cms Smetana
 * project: alt-money
 *
 */

use akiraz2\stat\models\WebVisitor;
use akiraz2\stat\Module;
use backend\widgets\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \akiraz2\stat\models\WebVisitorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $counter_direct */
/* @var $counter_inner */
/* @var $counter_search */
/* @var $counter_ads */

$this->title = Module::t('stat', 'WebStat Dashboard');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stat-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="content-top">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="col-md-4">
                    <div class="content-top-1">
                        <h3><?= Module::t('stat', 'Own Counter');?></h3>
                        <p><?= Module::t('stat', 'Direct');?>: <?= $counter_direct;?></p>
                        <p><?= Module::t('stat', 'Inner');?>: <?= $counter_inner;?></p>
                        <p><?= Module::t('stat', 'Search');?>: <?= $counter_search;?></p>
                        <p><?= Module::t('stat', 'Ads');?>: <?= $counter_ads;?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="content-top-1">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="content-top-1">

                    </div>
                </div>
            </div>
            <div class="box-body">
                    <?php if ($searchModel->getModule()->ownStat) { ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                'url',
//
//                                'user_agent',
                                [
                                    'attribute' => 'source',
                                    'value' => function ($model) {
                                        /* @var $model WebVisitor */
                                        return $model->getSource();
                                    },
                                    'filter' => Html::activeDropDownList(
                                        $searchModel, 'source', WebVisitor::getSourceList(), ['class' => 'form-control', 'prompt' => 'Все']
                                    ),
                                ],
//                                'ip_address',
                                'visits',
//                                'created_at',
//                                ['class' => 'yii\grid\ActionColumn'],
                            ],
                        ]); ?>
                    <?php } ?>
            </div>
        </div>
    </div>


</div>
