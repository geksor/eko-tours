<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Tour */
/* @var $models \common\models\Accom */

$this->title = $model->title;
$this->registerMetaTag([
    'name' => 'title',
    'content' => $model->meta_title,
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_description,
]);
$this->params['breadcrumbs'][] = ['label' => 'Туры', 'url' => ['/tours']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Описание</a></li>
        <li><a href="#tabs-2">Цены</a></li>
        <li><a href="#tabs-3">Проживание</a></li>
        <li><a href="#tabs-4">Важно знать</a></li>
        <li><a href="#tabs-5">Отзывы</a></li>
        <li><a href="#tabs-6">Забронировать</a></li>
    </ul>
    <div id="tabs-1">
        <div class="tour_in">
            <div class="tour_in_img">
                <? $images = $model->getBehavior('galleryBehavior')->getImages() ?>
                <div class="tour_in_img_1">
                    <? if ($images) {?>
                        <? foreach ($images as $image) {?>
                            <a href="<?= $image->getUrl('original') ?>" class="gall_link" data-fancybox="gallery10">
                                <img src="<?= $image->getUrl('medium') ?>" alt="<?= $image->name ?>">
                                <i class="fas fa-search-plus zoom_icon"></i>
                            </a>
                        <?}?>
                    <?}?>
                </div>
                <div class="tour_in_img_2">
                    <? if ($images) {?>
                        <a href="<?= $images[0]->getUrl('original') ?>" class="gall_link" data-fancybox="gallery10">
                        <img src="<?= $images[0]->getUrl('medium') ?>" alt="<?= $model->title ?>">
                        <i class="fas fa-search-plus zoom_icon"></i>
                    </a>
                    <?}?>
                </div>
            </div>
            <div class="tour_in_des">
                <h1 class="h2"><?= $model->title ?> от <span><?= Yii::$app->formatter->asInteger($model->min_price) ?> руб./чел.</span></h1>
                <p><strong><?= $model->short_description ?></strong></p>
                <?= $model->description ?>
            </div>
        </div>
    </div>
    <div id="tabs-2">
        <? if ($model->priceSections) {?>
            <? foreach ($model->priceSections as $priceSection) {/* @var $priceSection \common\models\PriceSection */?>
                <div class="tour_in">
                    <h2 class="h4"><?= $priceSection->title ?></h2>
                    <ul class="price_tour">
                        <? if ($priceSection->priceItems) {?>
                            <? foreach ($priceSection->priceItems as $priceItem) {/* @var  $priceItem \common\models\PriceItem */?>
                                <li>
                                    <p><?= $priceItem->text ?></p>
                                    <? if ($priceItem->tourPriceItems) {?>
                                        &nbsp;- <strong><?= $priceItem->tourPriceItems[0]->value ?></strong>
                                    <?}?>
                                </li>
                            <?}?>
                        <?}?>
                    </ul>

                    <div class="price_tour_img">
                        <a href="<?= $priceSection->getImage() ?>" class="gall_link" data-fancybox="gallery">
                            <img src="<?= $priceSection->getThumbImage() ?>" alt="<?= $priceSection->title ?>">
                            <i class="fas fa-search-plus zoom_icon"></i>
                        </a>
                    </div>
                </div>
            <?}?>
        <?}?>
    </div>
    <div id="tabs-3">
        <? if ($models) {?>
            <? foreach ($models as $accom) {/* @var $model \common\models\Accom */?>
                <div class="tour_in">
                    <h2 class="h4"><?= $accom->title ?></h2>
                    <div class="apart_des">
                        <? if ($accom->video_link) {?>
                            <iframe class="wid" src="https://www.youtube.com/embed/<?= $accom->video_link ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <?}?>
                        <?= $accom->description ?>
                    </div>
                    <div class="apart_in slider5 owl-carousel owl-theme">
                        <? if ($accom->is_gallery) {?>
                            <?$images = $accom->getBehavior('galleryBehavior')->getImages();?>

                            <? if ($images) {?>
                                <? foreach ($images as $image) {?>
                                    <a href="<?= $image->getUrl('original') ?>" class="gall_link" data-fancybox="<?= $accom->title ?>">
                                        <img src="<?= $image->getUrl('medium') ?>" alt="<?= $accom->title ?>">
                                        <i class="fas fa-search-plus zoom_icon"></i>
                                    </a>
                                <?}?>
                            <?}?>
                        <?}else{?>
                            <? if ($accom->rooms) {?>
                                <? foreach ($accom->rooms as $room) {/* @var $room \common\models\Room */?>
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
    <div id="tabs-4">
        <? if ($model->knows) {?>
            <? foreach ($model->knows as $know) { /* @var $model \common\models\Know */?>
                <div class="tour_in">
                    <h2 class="h4"><?= $know->title ?></h2>
                    <?= $know->text ?>
                    <div class="price_tour_img">
                        <? $images = $know->getBehavior('galleryBehavior')->getImages(); ?>
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
    <div id="tabs-5">
        <div class="review_in slider4 owl-carousel owl-theme">
            <? if ($model->reviews) {?>
                <? foreach ($model->reviews as $review) {?>
                    <div class="review item">
                        <h3><?= $review->user_name ?></h3>
                        <p class = "date"><?= Yii::$app->formatter->asDate($review->create_at, 'long') ?></p>
                        <p class="review_p">
                            <?= $review->text ?>
                        </p>
                    </div>
                <?}?>
            <?}?>
        </div>
        <a class="md-trigger zabron_read" data-modal="modal-2">Написать отзыв</a>
    </div>
    <div id="tabs-6">
        <div class="tour_in">
            <div class="price_tour_img">
                <a href="img/price_tour_img.jpg" class="gall_link" data-fancybox="gallery10">
                    <img src="img/price_tour_img.jpg" alt="работа">
                    <i class="fas fa-search-plus zoom_icon"></i>
                </a>
            </div>
            <div id="tabs_2" class = "raspisanie">
                <ul>
                    <li><a href="#tabs-1">Июнь 2018</a></li>
                    <li><a href="#tabs-2">Июль 2018</a></li>
                    <li><a href="#tabs-3">Август 2018</a></li>
                    <li><a href="#tabs-4">Сентябрь 2018</a></li>
                    <li><a href="#tabs-5">Октябрь 2018</a></li>
                    <li><a href="#tabs-6">Ноябрь 2018</a></li>
                    <li><a href="#tabs-1">Декабрь 2018</a></li>
                    <li><a href="#tabs-2">Январь 2019</a></li>
                    <li><a href="#tabs-3">Февраль 2019</a></li>
                    <li><a href="#tabs-4">Март 2019</a></li>
                    <li><a href="#tabs-5">Апрель 2019</a></li>
                    <li><a href="#tabs-6">Май 2019</a></li>
                </ul>
                <div id="tabs-1" class="program_tour">
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            01.07-07.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            07.07-14.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            14.07-21.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            21.07-28.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            28.07-05.08
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                </div>
                <div id="tabs-2" class="program_tour">
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            01.07-07.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            07.07-14.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            14.07-21.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            21.07-28.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            28.07-05.08
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                </div>
                <div id="tabs-3" class="program_tour">
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            01.07-07.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            07.07-14.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            14.07-21.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            21.07-28.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            28.07-05.08
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                </div>
                <div id="tabs-4" class="program_tour">
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            01.07-07.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            07.07-14.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            14.07-21.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            21.07-28.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            28.07-05.08
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                </div>
                <div id="tabs-5" class="program_tour">
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            01.07-07.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            07.07-14.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            14.07-21.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            21.07-28.07
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            28.07-05.08
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                </div>
                <div id="tabs-6" class="program_tour">
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            01.07-07.07.
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            01.07-07.07.
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            01.07-07.07.
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            01.07-07.07.
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                    <div class="raspisanie_day">
                        <div class="day_in day_date">
                            01.07-07.07.
                        </div>
                        <div class="day_in day_price">
                            от 23 700 руб
                        </div>
                        <div class="day_in day_mest">
                            Осталось мест: 5
                        </div>
                        <div class="day_in day_bron">
                            <a class="md-trigger" data-modal="modal-1">Забронировать</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bron_click_in">
    <a class="md-trigger zabron_read bron_click bron_click_1" data-modal="modal-1">Забронировать в 1 клик</a>
    <a class="md-trigger zabron_read bron_click bron_click_2" data-modal="modal-3">Бесплатная консультация</a>
    <a class="md-trigger zabron_read bron_click bron_click_3" data-modal="modal-4">Заказать звонок</a>
</div>
<h2 class="h3">Программа тура</h2>
<div id="tabs_1">
    <ul>
        <li><a href="#tabs-1-1">1-ый день</a></li>
        <li><a href="#tabs-1-2">2-ый день</a></li>
        <li><a href="#tabs-1-3">3-ый день</a></li>
        <li><a href="#tabs-1-4">4-ый день</a></li>
        <li><a href="#tabs-1-5">5-ый день</a></li>
        <li><a href="#tabs-1-6">6-ый день</a></li>
        <li><a href="#tabs-1-7">7-ый день</a></li>
    </ul>
    <div id="tabs-1-1" class="program_tour">
        <p><span>07:00 - 12:00</span>Встреча в Краснодаре в аэропорту или на вокзале - трансфер в гостевой дом.</p>
        <p><span>14:00</span>Размещение в уютном гостевом доме из ароматного сруба «Рябиновые бусы», «Рябиновые бусы», расположенного у самого подножья реки Белая или в гостевом доме «Горная лаванда».</p>
        <p><span>15:00</span>Обед, приготовленный поварами гостевого дома, включающий в себя разнообразные блюда домашней кухни.</p>
        <p><span>16:00</span> Экскурсия в Хаджохскую теснину. Уверяем, от впечатлений при посещении теснины Вы испытаете необычайный восторг. Здесь мощная река Белая умещается в 3-5 метровый проем. Что тут происходит во время весеннего таяния снегов рассказать нельзя. Но можно представить. А лучше приехать и самим услышать голос реки, которую скала пытается заковать в каменные наручники.</p>
        <p><span>20:00</span> Ужин в гостевом доме. В этот вечер, как и в любой другой, Вы также можете посетить сауну или баню, прогуляться по подвесному мосту или по берегу реки, ну и просто отдохнуть на природе.</p>
    </div>
    <div id="tabs-1-2" class="program_tour">
        <p><span>09:00</span>Завтрак от поваров гостевого дома.</p>
        <p><span>10:00</span>Экскурсия в поселок Гузерипль, посещение Партизанской поляны. В переводе с адыгейского «гозарипль» означает «наблюдательный». При въезде в поселок виден широкий скальный пояс хребта Каменное море, чуть дальше открывается вид на гору Тыбга – одну из высочайших вершин Адыгеи. Дорога из Гузерипля на Партизанскую поляну поднимается в гору, поэтому в пути придется набрать 900 метров высоты. Сама Партизанская поляна спряталась под скалой Нагой-Кош, высота которой 2090 метров над уровнем моря. Из этой точки Вы увезете с собой на память невероятное количество снимков.</p>
        <p><span>14:00</span>Пикник на природе. Мы готовим обеды и заботливо упаковываем их в ланч-боксы. Горячий чай и кофе также к Вашим услугам.</p>
        <p><span>15:00</span>Продолжение экскурсии на Партизанской поляне.</p>
        <p><span>20:00</span>Ужин в гостевом доме.</p>
    </div>
    <div id="tabs-1-3" class="program_tour">
        <p><span>09:00</span>Завтрак от поваров гостевого дома.</p>
        <p><span>10:00</span>Экскурсия в поселок Гузерипль, посещение Партизанской поляны. В переводе с адыгейского «гозарипль» означает «наблюдательный». При въезде в поселок виден широкий скальный пояс хребта Каменное море, чуть дальше открывается вид на гору Тыбга – одну из высочайших вершин Адыгеи. Дорога из Гузерипля на Партизанскую поляну поднимается в гору, поэтому в пути придется набрать 900 метров высоты. Сама Партизанская поляна спряталась под скалой Нагой-Кош, высота которой 2090 метров над уровнем моря. Из этой точки Вы увезете с собой на память невероятное количество снимков.</p>
        <p><span>14:00</span>Пикник на природе. Мы готовим обеды и заботливо упаковываем их в ланч-боксы. Горячий чай и кофе также к Вашим услугам.</p>
        <p><span>15:00</span>Продолжение экскурсии на Партизанской поляне.</p>
        <p><span>20:00</span>Ужин в гостевом доме.</p>
    </div>
    <div id="tabs-1-4" class="program_tour">
        <p><span>09:00</span>Завтрак от поваров гостевого дома.</p>
        <p><span>10:00</span>Экскурсия в поселок Гузерипль, посещение Партизанской поляны. В переводе с адыгейского «гозарипль» означает «наблюдательный». При въезде в поселок виден широкий скальный пояс хребта Каменное море, чуть дальше открывается вид на гору Тыбга – одну из высочайших вершин Адыгеи. Дорога из Гузерипля на Партизанскую поляну поднимается в гору, поэтому в пути придется набрать 900 метров высоты. Сама Партизанская поляна спряталась под скалой Нагой-Кош, высота которой 2090 метров над уровнем моря. Из этой точки Вы увезете с собой на память невероятное количество снимков.</p>
        <p><span>14:00</span>Пикник на природе. Мы готовим обеды и заботливо упаковываем их в ланч-боксы. Горячий чай и кофе также к Вашим услугам.</p>
        <p><span>15:00</span>Продолжение экскурсии на Партизанской поляне.</p>
        <p><span>20:00</span>Ужин в гостевом доме.</p>
    </div>
    <div id="tabs-1-5" class="program_tour">
        <p><span>09:00</span>Завтрак от поваров гостевого дома.</p>
        <p><span>10:00</span>Экскурсия в поселок Гузерипль, посещение Партизанской поляны. В переводе с адыгейского «гозарипль» означает «наблюдательный». При въезде в поселок виден широкий скальный пояс хребта Каменное море, чуть дальше открывается вид на гору Тыбга – одну из высочайших вершин Адыгеи. Дорога из Гузерипля на Партизанскую поляну поднимается в гору, поэтому в пути придется набрать 900 метров высоты. Сама Партизанская поляна спряталась под скалой Нагой-Кош, высота которой 2090 метров над уровнем моря. Из этой точки Вы увезете с собой на память невероятное количество снимков.</p>
        <p><span>14:00</span>Пикник на природе. Мы готовим обеды и заботливо упаковываем их в ланч-боксы. Горячий чай и кофе также к Вашим услугам.</p>
        <p><span>15:00</span>Продолжение экскурсии на Партизанской поляне.</p>
        <p><span>20:00</span>Ужин в гостевом доме.</p>
    </div>
    <div id="tabs-1-6" class="program_tour">
        <p><span>09:00</span>Завтрак от поваров гостевого дома.</p>
        <p><span>10:00</span>Экскурсия в поселок Гузерипль, посещение Партизанской поляны. В переводе с адыгейского «гозарипль» означает «наблюдательный». При въезде в поселок виден широкий скальный пояс хребта Каменное море, чуть дальше открывается вид на гору Тыбга – одну из высочайших вершин Адыгеи. Дорога из Гузерипля на Партизанскую поляну поднимается в гору, поэтому в пути придется набрать 900 метров высоты. Сама Партизанская поляна спряталась под скалой Нагой-Кош, высота которой 2090 метров над уровнем моря. Из этой точки Вы увезете с собой на память невероятное количество снимков.</p>
        <p><span>14:00</span>Пикник на природе. Мы готовим обеды и заботливо упаковываем их в ланч-боксы. Горячий чай и кофе также к Вашим услугам.</p>
        <p><span>15:00</span>Продолжение экскурсии на Партизанской поляне.</p>
        <p><span>20:00</span>Ужин в гостевом доме.</p>
    </div>
    <div id="tabs-1-7" class="program_tour">
        <p><span>09:00</span>Завтрак от поваров гостевого дома.</p>
        <p><span>10:00</span>Экскурсия в поселок Гузерипль, посещение Партизанской поляны. В переводе с адыгейского «гозарипль» означает «наблюдательный». При въезде в поселок виден широкий скальный пояс хребта Каменное море, чуть дальше открывается вид на гору Тыбга – одну из высочайших вершин Адыгеи. Дорога из Гузерипля на Партизанскую поляну поднимается в гору, поэтому в пути придется набрать 900 метров высоты. Сама Партизанская поляна спряталась под скалой Нагой-Кош, высота которой 2090 метров над уровнем моря. Из этой точки Вы увезете с собой на память невероятное количество снимков.</p>
        <p><span>14:00</span>Пикник на природе. Мы готовим обеды и заботливо упаковываем их в ланч-боксы. Горячий чай и кофе также к Вашим услугам.</p>
        <p><span>15:00</span>Продолжение экскурсии на Партизанской поляне.</p>
        <p><span>20:00</span>Ужин в гостевом доме.</p>
    </div>
</div>
<?
$js = <<<JS
        $( function() {
            $( "#tabs" ).tabs();
        } );
        $( function() {
            $( "#tabs_1" ).tabs();
        } );
        $( function() {
            $( "#tabs_2" ).tabs();
        } );
        
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