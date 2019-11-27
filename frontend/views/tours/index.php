<?php

/* @var $this yii\web\View */
/* @var $models \common\models\Tour */
/* @var $category \common\models\Category */
///* @var $pageParams \common\models\ToursPage */
///* @var $cityModels \common\models\City */
///* @var $attrModels \common\models\Attr */
///* @var $city_id */
///* @var $attr_id */


$this->title = $category->meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $category->meta_description,
]);
$this->params['breadcrumbs'][] = $category->title;

?>

<div class="pages">
    <h1 class = "h3"><?= $category->title ?></h1>

<!--    <div class="head_nap">-->
<!--        <ul>-->
<!--            --><?// foreach ($cityModels as $key => $city) {/* @var $city \common\models\City */?>
<!--                --><?// if ($city->tours) {?>
<!--                    <li>-->
<!--                        <a href="--><?//= \yii\helpers\Url::to(['/tours', 'city_id' => $city->id]) ?><!--" class="--><?//= $city->id===$city_id?'active':'' ?><!--">--><?//= $city->title ?><!--</a>-->
<!--                    </li>-->
<!--                --><?//}?>
<!--            --><?//}?>
<!--        </ul>-->
<!--    </div>-->
<!--    <div class="head_nap">-->
<!--        <ul>-->
<!--            --><?// foreach ($attrModels as $key => $attr) {/* @var $attr \common\models\Attr */?>
<!--                --><?// if ($attr->tours) {?>
<!--                    <li>-->
<!--                        <a href="--><?//= \yii\helpers\Url::to(['/tours', 'attr_id' => $attr->id]) ?><!--" class="--><?//= $attr->id===$attr_id?'active':'' ?><!--">--><?//= $attr->title ?><!--</a>-->
<!--                    </li>-->
<!--                --><?//}?>
<!--            --><?//}?>
<!--        </ul>-->
<!--    </div>-->

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
                                <p class="title_1"><a href="<?= \yii\helpers\Url::to(['view', 'category' => $category->alias, 'alias' => $model->alias]) ?>" class="info_read">Подробнее</a></p>
                                <p class="title_2"><a data-modal="modal-tour" data-tour_id="<?= $model->id ?>" class="md-trigger info_bron tour_booking">Забронировать</a></p>
                            </div>
                        </div>
                    </section>
                <?}?>
            </div>
        <?}?>
        <div class="page_description">
            <?= $category->description ?>
        </div>
    </div>


</div>
<?

$js = <<<JS

    $('.tour_booking').on('click', function() {
        var tourId = $('#'+$(this).attr('data-modal')).find('#booking-tour_id');
        tourId.val($(this).attr('data-tour_id'));
    });
JS;

$this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
?>