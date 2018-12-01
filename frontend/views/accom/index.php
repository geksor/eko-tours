<?php

/* @var $this yii\web\View */
/* @var $models \common\models\Accom */
/* @var $pageParams \common\models\AccomPage */

$this->title = $pageParams->title;
$this->registerMetaTag([
    'name' => 'title',
    'content' => $pageParams->meta_title,
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $pageParams->meta_description,
]);
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="pages">
    <h1 class = "h3"><?= $this->title ?></h1>

    <div class="pages_cont">
        <? if ($models) {?>
            <? foreach ($models as $model) {/* @var $model \common\models\Accom */?>
                <div class="tour_in">
                <h2 class="h4"><?= $model->title ?></h2>
                <div class="apart_des">
                    <? if ($model->video_link) {?>
                        <iframe class="wid" src="https://www.youtube.com/embed/<?= $model->video_link ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <?}?>
                    <?= $model->description ?>
                </div>
                <div class="apart_in slider5 owl-carousel owl-theme">
                    <? if ($model->is_gallery) {?>
                        <?$images = $model->getBehavior('galleryBehavior')->getImages();?>

                        <? if ($images) {?>
                            <? foreach ($images as $image) {?>
                                <a href="<?= $image->getUrl('original') ?>" class="gall_link" data-fancybox="<?= $model->title ?>">
                                    <img src="<?= $image->getUrl('medium') ?>" alt="<?= $model->title ?>">
                                    <i class="fas fa-search-plus zoom_icon"></i>
                                </a>
                            <?}?>
                        <?}?>
                    <?}else{?>
                        <? if ($model->rooms) {?>
                            <? foreach ($model->rooms as $room) {/* @var $room \common\models\Room */?>
                                <div class="apart item" style="position: relative; padding-top: 130.72%;">

                                    <?$images = $room->getBehavior('galleryBehavior')->getImages();?>

                                    <? if ($images) {?>
                                        <a href="<?= $images[0]->getUrl('original') ?>" data-fancybox="<?= $room->title ?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                            <img src="<?= $images[0]->getUrl('medium') ?>" alt="<?= $room->title ?>" class="apart_img" style="height: 100%; width: 100%; object-fit: cover">
                                        </a>
                                        <div class="gallery_nom_1" style="display: none">
                                            <? foreach ($images as $key => $image) {?>
                                                <? if ($key === 0) {continue;}?>

                                                <a href="<?= $image->getUrl('original') ?>" data-fancybox="<?= $room->title ?>">
                                                    <img src="<?= $image->getUrl('medium') ?>" alt="<?= $room->title ?>">
                                                </a>

                                            <?}?>
                                        </div>
                                    <?}?>

                                    <h3 class="ap_name"><?= $room->title ?></h3>
                                    <div class="icons_ap">
                                        <? if ($room->attributes0) {?>
                                            <? foreach ($room->attributes0 as $attr) {/* @var $attr \common\models\Attribute */?>
                                                <div class="ico">
                                                    <span class="ic_title"><?= $attr->title ?></span>
                                                    <img src="<?= $attr->getThumbImage() ?>" alt="<?= $attr->title ?>">
                                                </div>
                                            <?}?>
                                        <?}?>
                                    </div>
                                </div>
                            <?}?>
                        <?}?>
                    <?}?>
                </div>
            </div>
            <?}?>
        <?}?>
    </div>


</div>

<?
$js = <<< JS
$('.slider5').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            500:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });
JS;

$this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
?>

