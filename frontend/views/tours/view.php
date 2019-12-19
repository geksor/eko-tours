<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Tour */
/* @var $models \common\models\Accom */
///* @var $pageParamsTours \common\models\ToursPage */
/* @var $category \common\models\Category */
/* @var $stageModels \common\models\Stage*/
/* @var $stage \common\models\Stage */
/* @var $stageAccoms \common\models\Accom*/
/* @var $accom \common\models\Accom */
/* @var $stagePrices \common\models\StagePrice*/
/* @var $stagePrice \common\models\StagePrice*/

$this->title = $model->meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_description,
]);
$this->params['breadcrumbs'][] = ['label' => $category->title, 'url' => ["/tours/$category->alias"]];
$this->params['breadcrumbs'][] = $model->title;

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
                        <? $i = 1; foreach ($images as $image) {?>
                            <? if ($i>1 && $i < 6) {?>
                            <a href="<?= $image->getUrl('original') ?>" class="gall_link" data-fancybox="gallery-main">
                                <img src="<?= $image->getUrl('medium') ?>" alt="<?= $image->name ?>">
                            </a>
                            <?}elseif ($i === 1){?>

                            <?}else{?>
                                <a href="<?= $image->getUrl('original') ?>" class="gall_link" data-fancybox="gallery-main" style="display: none">
                                    <img src="<?= $image->getUrl('medium') ?>" alt="<?= $image->name ?>">
                                </a>
                            <?}?>
                        <?$i++;}?>
                    <?}?>
                </div>
                <div class="tour_in_img_2">
                    <? if ($images) {?>
                        <a href="<?= $images[0]->getUrl('original') ?>" class="gall_link" data-fancybox="gallery-main">
                        <img src="<?= $images[0]->getUrl('medium') ?>" alt="<?= $model->title ?>">
                    </a>
                    <?}?>
                </div>
            </div>
            <div class="tour_in_des">
                <h1 class="h2"><?= $model->title ?><br><?= $model->title_add ?> от <span><?= Yii::$app->formatter->asInteger($model->min_price) ?> руб./чел.</span></h1>
                <p><strong><?= $model->short_description ?></strong></p>
                <?= $model->description ?>
            </div>
        </div>
    </div>
    <div id="tabs-2">
        <div class="tabs">
            <div class="dropdown">
                <button id="clickDropDown" class="dropbtn">Выбрать период
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="20" height="12"
                         viewBox="0 0 20 12">
                        <defs />
                        <path fill="#3C3C3C"
                              d="M1.721.79L10 9.07 18.277.787a1.009 1.009 0 111.428 1.43l-8.992 8.993a1.008 1.008 0 01-1.426 0L.295 2.217A1.008 1.008 0 111.721.79z" />
                    </svg>
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <ul class="tabs__caption">
                        <?php foreach ($stageModels as $key=>$stage) {?>
                            <li class="<?= $key !== 0?:'active' ?>">
                                <?= Yii::$app->formatter->asDate($stage->start_date, 'php:d.m.y') ?> - <?= Yii::$app->formatter->asDate($stage->end_date, 'php:d.m.y') ?>
                                (<?= ($stage->end_date - $stage->start_date)/(60*60*24) ?> дней)</li>
                        <?}?>
                    </ul>
                </div>
            </div>

            <?php foreach ($stageModels as $key=>$stage) {?>
                <div class="tabs__content <?= $key !== 0?:'active' ?>">
                    <?php foreach ($stageAccoms[$stage->id] as $accom) {?>
                        <div class="tour_in tour_know">
                            <h2 class="h4">Стоимость тура при размещении в гостевом доме «<?= $accom->title ?>» с <?= Yii::$app->formatter->asDate($stage->start_date, 'php:d.m.y') ?>
                                по
                                <?= Yii::$app->formatter->asDate($stage->end_date, 'php:d.m.y') ?></h2>
                            <ul class="price_tour">
                                <?foreach ($stagePrices[$stage->id][$accom->id] as $stagePrice) {?>
                                    <li class="bg-active" style="background-image: url(<?= $stagePrice->getThumbImage() ?>)">
                                        <p><?= $stagePrice->title ?></p>
                                        <span class="indicator"><?= $stagePrice->place_count ?></span>
                                        &nbsp;- <strong><?= $stagePrice->price ?></strong>
                                    </li>
                                <?}?>
                            </ul>
                        </div>
                    <?}?>
                </div>
            <?}?>

        </div>

        <? if ($model->priceSections && 1 === 2) {?>
            <? foreach ($model->priceSections as $priceSection) {/* @var $priceSection \common\models\PriceSection */?>
                <div class="tour_in tour_know">
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
        <? if ($model->accoms) {?>
            <? foreach ($model->accoms as $accom) {/* @var $model \common\models\Accom */?>
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
                                    <a href="<?= $image->getUrl('original') ?>" class="gall_link" data-fancybox="gallery-<?= $accom->id ?>">
                                        <img src="<?= $image->getUrl('medium') ?>" alt="<?= $accom->title ?>">
                                    </a>
                                <?}?>
                            <?}?>
                        <?}else{?>
                            <? if ($accom->rooms) {?>
                                <? foreach ($accom->rooms as $room) {/* @var $room \common\models\Room */?>
                                    <div class="apart item" style="position: relative; padding-top: 130.72%;">

                                        <?$images = $room->getBehavior('galleryBehavior')->getImages();?>

                                        <? if ($images) {?>
                                            <a href="<?= $images[0]->getUrl('original') ?>" data-fancybox="gallery-<?= $room->id ?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                                <img src="<?= $images[0]->getUrl('medium') ?>" alt="<?= $room->title ?>" class="apart_img" style="height: 100%; width: 100%; object-fit: cover">
                                            </a>
                                            <div class="gallery_nom_1" style="display: none">
                                                <? foreach ($images as $key => $image) {?>
                                                    <? if ($key === 0) {continue;}?>

                                                    <a href="<?= $image->getUrl('original') ?>" data-fancybox="gallery-<?= $room->id ?>">
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
                <div class="tour_in tour_know">
                    <h2 class="h4"><?= $know->title ?></h2>
                    <?= $know->text ?>
                    <div class="price_tour_img">
                        <? $images = $know->getBehavior('galleryBehavior')->getImages(); ?>
                        <? if ($images) {?>
                            <?
                                $i = 1;
                                $count = $know->image_count?(integer)$know->image_count:2;

                                foreach ($images as $image) {?>
                                    <? if ($i <= $count) {?>
                                        <a href="<?= $image->getUrl('original') ?>" class="gall_link" data-fancybox="gallery-know">
                                            <img src="<?= $image->getUrl('medium') ?>" alt="<?= $image->name ?>">
                                            <i class="fas fa-search-plus zoom_icon"></i>
                                        </a>
                                    <?}else{break;}?>
                            <?$i++;}?>
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
        <a class="md-trigger zabron_read reviewsButton" data-tour="<?= $model->id ?>" data-modal="reviews">Написать отзыв</a>
    </div>
    <div id="tabs-6">
        <div class="tour_in">
            <? if ($model->months) {?>
                <? foreach ($model->months as $keyImage => $monsImage) {?>
                    <div id="<?= $monsImage->id ?>" class="price_tour_img" <?= $keyImage!==0?'style="display:none;"':'' ?>>
                        <a href="<?= $monsImage->getImage() ?>" class="gall_link" data-fancybox="gallery-booking">
                            <img src="<?= $monsImage->getThumbImage() ?>" alt="Картинка">
                            <i class="fas fa-search-plus zoom_icon"></i>
                        </a>
                    </div>
                <?}?>
            <?}?>
            <div id="tabs_2" class = "raspisanie">
                <? if ($model->months) {?>
                    <ul>
                        <? foreach ($model->months as $key => $month) {?>
                            <li class="tabsMonth" data-id="<?= $month->id ?>" >
                                <a href="#tabs-<?= $key ?>">
                                    <?= Yii::$app->formatter->asDate($month->title, 'php:M Y') ?>
                                </a>
                            </li>
                        <?}?>
                    </ul>
                    <? foreach ($model->months as $key1 => $month1) {?>
                        <div id="tabs-<?= $key1 ?>" class="program_tour">
                            <? if ($month1->stages) {?>
                                <? foreach ($month1->stages as $stage) {?>
                                    <div class="raspisanie_day">
                                        <div class="day_in day_date">
                                            <?= Yii::$app->formatter->asDate($stage->start_date, 'php:d.m') ?>-<?= Yii::$app->formatter->asDate($stage->end_date, 'php:d.m') ?>
                                        </div>
                                        <div class="day_in day_price">
                                            от <?= Yii::$app->formatter->asInteger($stage->price) ?> руб
                                        </div>
                                        <div class="day_in day_mest">
                                            Осталось мест: <?= $stage->places ?>
                                        </div>
                                        <div class="day_in day_bron">
                                            <a class="md-trigger tour-stage_booking"
                                               data-tour_id="<?= $model->id ?>"
                                               data-month_id="<?= $month1->id ?>"
                                               data-stage_id="<?= $stage->id ?>"
                                               data-modal="modal-tour-stage"
                                            >Забронировать</a>
                                        </div>
                                    </div>
                                <?}?>
                            <?}?>
                        </div>
                    <?}?>
                <?}?>
            </div>
        </div>
    </div>
</div>
<div class="bron_click_in">
    <a class="md-trigger zabron_read bron_click bron_click_1 tour_booking" data-modal="modal-tour" data-tour_id="<?= $model->id ?>">Забронировать в 1 клик</a>
    <a class="md-trigger zabron_read bron_click bron_click_2 tour_callBack" data-modal="modal-callBack" data-is_consult="1">Бесплатная консультация</a>
    <a class="md-trigger zabron_read bron_click bron_click_3 tour_callBack" data-modal="modal-callBack" data-is_consult="0">Заказать звонок</a>
</div>
<? if ($model->timetableDays) {?>
    <h2 class="h3">Программа тура</h2>
    <div id="tabs_1">
        <ul>
            <? foreach ($model->timetableDays as $timetableDay) {?>
                <li><a href="#tabs-1-<?= $timetableDay->id ?>"><?= $timetableDay->day_number ?>-й день</a></li>
            <?}?>
        </ul>
        <? foreach ($model->timetableDays as $timetableDay1) {?>
            <div id="tabs-1-<?= $timetableDay1->id ?>" class="program_tour">
                <? if ($timetableDay1->timetableItems) {?>
                    <? foreach ($timetableDay1->timetableItems as $timetableItem) {?>
                        <p>
                        <span><?= Yii::$app->formatter->asDate($timetableItem->start_time, 'php:H:i') ?><?= $timetableItem->end_time?' - '.Yii::$app->formatter->asDate($timetableItem->end_time, 'php:H:i'):'' ?></span>
                        <?= $timetableItem->text ?>
                    </p>
                    <?}?>
                <?}?>
            </div>
        <?}?>
    </div>
<?}?>
<?
$js = <<<JS

        $('.tour_booking').on('click', function() {
            var tourId = $('#'+$(this).attr('data-modal')).find('#booking-tour_id');
            tourId.val($(this).attr('data-tour_id'));
        });
        $('.tour-stage_booking').on('click', function() {
            var popUpBlock = $('#'+$(this).attr('data-modal'));
            var tourId = popUpBlock.find('#booking-tour_id');
            var monthId = popUpBlock.find('#booking-month_id');
            var stageId = popUpBlock.find('#booking-stage_id');
            tourId.val($(this).attr('data-tour_id'));
            monthId.val($(this).attr('data-month_id'));
            stageId.val($(this).attr('data-stage_id'));
        });
        
        $('.tour_callBack').on('click', function() {
            $('.callBackHeader').text($(this).text());
            $('.isConsult').val($(this).attr('data-is_consult'));
        });
        
        $('.reviewsButton').on('click', function() {
            $('#reviews-tour_id').val($(this).attr('data-tour'));
        });
        
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
    $('.tabsMonth').on('click', function() {
        $('.price_tour_img').hide();
        $('#'+$(this).attr('data-id')).show();
    });
    $('#clickDropDown').on('click', function() {
      $('#myDropdown').toggleClass('show');
    });
JS;

$this->registerJs($js, $position = yii\web\View::POS_END, $key = null);

?>