<?php

/* @var $this yii\web\View */
/* @var $model \common\models\HomePage */

$this->title = $model->title;
$this->registerMetaTag([
    'name' => 'title',
    'content' => $model->meta_title,
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_description,
]);
?>
<div class="all">
    <div class="all cont">
        <div class="all_1">
            <p>
                <?= $model->text ?>
            </p>
            <div class="all_img">
                <img src="/public/img/all.jpg" alt="Адыгея отдых">
                <img src="/public/img/all_1.jpg" alt="Адыгея отдых">
                <img src="/public/img/all_2.jpg" alt="Адыгея отдых">
            </div>
        </div>
        <div class="all_1 all_2">
            <h3><?= $model->rightBlock_title ?></h3>
            <?= $model->rightBlock_text ?>
        </div>
    </div>
</div>

<?= \frontend\widgets\ToursHomeWidget::widget() ?>

<?= \frontend\widgets\HotelHomeWidget::widget() ?>

<div class="cont">
    <div class = "h2_inst">
        <img src="/public/img/insta.png" alt="eko_tours_adigea">
        <p>/eko_tours_adigea</p>
    </div>
    <div class="tours">
        <div class="slider3 owl-carousel owl-theme">
<!--            --><?//include 'public/inwidget/template.php'?>
        </div>
    </div>
</div>

<?= \frontend\widgets\ReviewsHomeWidget::widget() ?>

<div class = "cont zabron">
    <h2 class = "h2">Забронировать тур в один клик</h2>
    <a class="md-trigger zabron_read" data-modal="modal-1">Поехали!</a>
</div>
<div id="map" class="map">
    <?= array_key_exists('mapScript', Yii::$app->params['Contact'])?Yii::$app->params['Contact']['mapScript']:'' ?>
</div>
