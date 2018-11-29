<?

/* @var $items \frontend\widgets\HeaderMenuWidget */
/* @var $models \common\models\Accom */

?>

<div class="hotels">
    <div class="cont">
        <h2 class = "h2">Размещение</h2>
        <div class="tours">
            <div class="slider2 owl-carousel owl-theme">
                <? if ($models) {?>
                    <? foreach ($models as $model) {/* @var $model \common\models\Accom */?>
                        <section class="item hotel">
                            <div class="thumbs">
                                <img src="<?= $model->getThumbImage() ?>" alt="<?= $model->title ?>">
                                <h3 class = "aa tour_h3"><?= $model->title ?></h3>
                                <div class="caption">
                                    <p class="title tour_h3"><?= $model->title ?></p>
                                    <p class="title_1"><a href="/hotel.php" class="info_read">Подробнее</a></p>
                                </div>
                            </div>
                        </section>
                    <?}?>
                <?}?>
            </div>
        </div>
    </div>
</div>
