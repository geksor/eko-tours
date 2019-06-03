<?php
/* @var $this yii\web\View */
/* @var $model \common\models\HomePage */
/* @var $galleryImages */

$this->title = $model->meta_title;
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
            <? if ($galleryImages) {?>
                <div class="all_img">
                    <? $i = 1 ?>
                    <? foreach ($galleryImages as $image) {?>
                        <? if ($i <= 3) {?>
                            <img src="<?= $image->getUrl('medium') ?>" alt="<?= $image->name ?>">
                        <?}else{break;}?>
                    <?$i++;}?>
                </div>
            <?}?>
        </div>
        <div class="all_1 all_2">
            <h3><?= $model->rightBlock_title ?></h3>
            <?= $model->rightBlock_text ?>
        </div>
    </div>
</div>

<?= \frontend\widgets\ToursHomeWidget::widget() ?>

<div class="cont">
    <div class = "h2_inst">
        <img src="/public/img/insta.png" alt="eko_tours_adigea">
        <p>/eko_tours_adigea</p>
    </div>
    <div class="tours">
        <div class="slider3 owl-carousel owl-theme" style="font-size: 0;line-height: 0">
            <?= \frontend\widgets\InwidgetWrapper::widget() ?>
        </div>
    </div>
</div>

<?= \frontend\widgets\ReviewsHomeWidget::widget() ?>

<div class = "cont zabron">
    <h2 class = "h2">Забронировать тур в один клик</h2>
    <a class="md-trigger zabron_read" data-modal="modal-tour">Поехали!</a>
</div>
<!--
<div id="map" class="map">
    <?= array_key_exists('mapScript', Yii::$app->params['Contact'])?Yii::$app->params['Contact']['mapScript']:'' ?>
</div>
-->
