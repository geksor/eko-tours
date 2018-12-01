<?

/* @var $items \frontend\widgets\HeaderMenuWidget */
/* @var $models \common\models\Tour */

?>

<div class="cont" id = "tours">
    <h2 class = "h2">Наши туры</h2>
    <div class="tours">
        <? if ($models) {?>
        <div class="slider1 owl-carousel owl-theme">
            <? foreach ($models as $model) {/* @var $model \common\models\Tour */
                $images = $model->getBehavior('galleryBehavior')->getImages();
            ?>
                <section class="item tour">
                    <div class="thumbs" style="padding-top: 97.5%">
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
                        <div class="fire">
                            <? if ($model->hot) {?>
                                <div class="fire_tour">Горящий тур</div>
                            <?}?>
                            <? if ($model->places_count) {?>
                                <div class="fire_all">Мест отслость: <?= $model->places_count ?></div>
                            <?}?>
                        </div>
                        <h3 class = "aa tour_h3"><?= $model->title ?><br>от <?= Yii::$app->formatter->asInteger($model->min_price) ?> руб./чел.</h3>
                        <div class="caption">
                            <p class="title tour_h3"><?= $model->title ?><br>от <?= Yii::$app->formatter->asInteger($model->min_price) ?> руб./чел.</p>
                            <p class="title_1"><a href="/pages.php" class="info_read">Подробнее</a></p>
                            <p class="title_2"><a href="/pages.php" class="info_bron">Забронировать</a></p>
                        </div>
                    </div>
                </section>
            <?}?>
        </div>
    <?}?>
    </div>
</div>

<?

$js = <<<JS
    $('.slider1').owlCarousel({
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
                items:3
            }
        }
    });
JS;

$this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
?>