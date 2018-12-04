<?php

/* @var $this yii\web\View */
/* @var $models \common\models\Tour */
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
            <div class="tours">
                <? foreach ($models as $model) {/* @var $model \common\models\Tour */
                    $images = $model->getBehavior('galleryBehavior')->getImages();
                    ?>
                    <section class="item tour">
                        <div class="thumbs" style="padding-top: 97.5%">
                            <? if ($images) {?>
                                <img src="<?= $images[0]->getUrl('medium') ?>" alt="<?= $model->title ?>"
                                     style="-webkit-filter: brightness(0.5);
                                        filter: brightness(0.5);
                                        position: absolute;
                                        z-index: -1;
                                        height: 100%;
                                        width: 100%;
                                        top: 0;
                                        left: 0;
                                        object-fit: cover"
                                >
                            <?}?>
                            <div class="fire">
                                <? if ($model->hot) {?>
                                    <div class="fire_tour">Горящий тур</div>
                                <?}?>
                                <? if ($model->free_field) {?>
                                    <div class="fire_tour"><?= $model->free_field ?></div>
                                <?}?>
                                <? if ($model->places_count) {?>
                                    <div class="fire_all">Мест отслость: <?= $model->places_count ?></div>
                                <?}?>                            </div>
                            <h3 class = "aa tour_h3"><?= $model->title ?> <?= $model->title_add ?><br>от <?= Yii::$app->formatter->asInteger($model->min_price) ?> руб./чел.</h3>
                            <div class="caption">
                                <p class="title tour_h3"><?= $model->title ?> <?= $model->title_add ?><br>от <?= Yii::$app->formatter->asInteger($model->min_price) ?> руб./чел.</p>
                                <p class="title_1"><a href="<?= \yii\helpers\Url::to(['view', 'alias' => $model->alias]) ?>" class="info_read">Подробнее</a></p>
                                <p class="title_2"><a href="/pages.php" class="info_bron">Забронировать</a></p>
                            </div>
                        </div>
                    </section>
                <?}?>
            </div>
        <?}?>
    </div>


</div>
