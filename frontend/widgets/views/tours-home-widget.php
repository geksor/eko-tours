<?

/* @var $items \frontend\widgets\MenuWidget */
/* @var $models \common\models\Tour[] */

?>

<div class="cont" id = "tours">
    <h2 class = "h2">Наши туры</h2>
    <div class="tours">
        <? if ($models) {?>
        <div class="geksor__tourFoHome">
            <? foreach ($models as $model) {
                if ($model->categories){
                    $images = $model->getBehavior('galleryBehavior')->getImages();?>
                    <div class="geksor__tourItem">
                        <section class="item tour">
                            <div class="thumbs" style="padding-top: 97.5%">
                                <? if ($images) {?>
                                    <img src="<?= $images[0]->getUrl('medium') ?>" alt="<?= $model->title ?>"
                                         style="
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
                                        <div class="fire_all">Мест осталось: <?= $model->places_count ?></div>
                                    <?}?>
                                </div>
                                <h3 class = "aa tour_h3"><?= $model->title ?> <?= $model->title_add ?><br>от <?= Yii::$app->formatter->asInteger($model->min_price) ?> руб./чел.</h3>
                                <div class="caption">
                                    <p class="title tour_h3"><?= $model->title ?> <?= $model->title_add ?><br>от <?= Yii::$app->formatter->asInteger($model->min_price) ?> руб./чел.</p>
                                    <p class="title_1"><a href="<?= \yii\helpers\Url::to(['/tours/view', 'category' => $model->categories[0]->alias, 'alias' => $model->alias]) ?>" class="info_read">Подробнее</a></p>
                                    <p class="title_2"><a data-modal="modal-tour" data-tour_id="<?= $model->id ?>" class="md-trigger info_bron tour_booking">Забронировать</a></p>
                                </div>
                            </div>
                        </section>
                    </div>
                <?}?>
            <?}?>
        </div>
    <?}?>
    </div>
</div>

<?

$js = <<<JS

    $('.tour_booking').on('click', function() {
        var tourId = $('#'+$(this).attr('data-modal')).find('#booking-tour_id');
        tourId.val($(this).attr('data-tour_id'));
    });

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
