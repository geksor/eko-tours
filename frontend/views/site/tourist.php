<?php

/* @var $this yii\web\View */
/* @var $models \common\models\Know */
/* @var $pageParams \common\models\TouristPage */

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
            <? foreach ($models as $model) { /* @var $model \common\models\Know */?>
                <div class="tour_in">
                    <h2 class="h4"><?= $model->title ?></h2>
                    <?= $model->text ?>
                    <div class="price_tour_img">
                        <? $images = $model->getBehavior('galleryBehavior')->getImages(); ?>
                        <? if ($images) {?>
                            <? foreach ($images as $image) {?>
                                <a href="<?= $image->getUrl('original') ?>" class="gall_link" data-fancybox="gallery10">
                                    <img src="<?= $image->getUrl('medium') ?>" alt="<?= $image->name ?>">
                                    <i class="fas fa-search-plus zoom_icon"></i>
                                </a>
                            <?}?>
                        <?}?>
                    </div>
                </div>
            <?}?>
        <?}?>
    </div>
</div>
