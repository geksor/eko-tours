<?php

/* @var $this yii\web\View */
/* @var $models \common\models\City */
/* @var $selectModel \common\models\City */
/* @var $pageParams \common\models\TimetablePage */

$this->title = $pageParams->meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $pageParams->meta_description,
]);
$this->params['breadcrumbs'][] = $pageParams->title?$pageParams->title:'Расписание';
?>

<div class="pages">
    <h1 class = "h3"><?= $pageParams->title?$pageParams->title:'Расписание' ?></h1>
    <? if ($models) {?>
    <div class="head_nap">
            <ul>
                <? foreach ($models as $key => $city) {/* @var $city \common\models\City */?>
                    <? if ($city->tours) {?>
                        <li>
                            <a href="<?= \yii\helpers\Url::to(['timetable', 'id' => $city->id]) ?>" class="<?= $city->id===$selectModel->id?'active':'' ?>"><?= $city->title ?></a>
                        </li>
                    <?}?>
                <?}?>
            </ul>
    </div>
    <div class="pages_cont">
        <div class="tour_in">
            <div class = "raspisanie shedule mainTabs" style="width: 100% !important;">
<!--                <ul>-->
<!--                    --><?// foreach ($selectModel->tours as $tour) {?>
<!--                        <li><a href="#tabs---><?//= $tour->id ?><!--">--><?//= $tour->title.' '.$tour->title_add ?><!--</a></li>-->
<!--                    --><?//}?>
<!--                </ul>-->
                <? foreach ($selectModel->tours as $tour) {?>
<!--                    <div id="tabs---><?//= $tour->id ?><!--" class="program_tour">-->
                        <div class = "raspisanie shedule mainTabs" style="width: 100% !important;">
                            <ul>
                                <? foreach ($tour->months as $month) {?>
                                    <li>
                                        <a href="#tabs-<?= $month->id ?>">
                                            <?= Yii::$app->formatter->asDate($month->title, 'php:M Y') ?>
                                        </a>
                                    </li>
                                <?}?>
                            </ul>
                            <? foreach ($tour->months as $month) {?>
                                <div id="tabs-<?= $month->id ?>" class="program_tour">
                                    <? foreach ($month->stages as $stage) {?>
                                        <div class="raspisanie_day">
                                            <div class="day_in day_date">
                                                <a href = "/tours/<?= $tour->alias ?>"><?= $tour->title ?></a>
                                            </div>
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
                                                   data-tour_id="<?= $tour->id ?>"
                                                   data-month_id="<?= $month->id ?>"
                                                   data-stage_id="<?= $stage->id ?>"
                                                   data-modal="modal-tour-stage"
                                                >Забронировать</a>
                                            </div>
                                        </div>
                                    <?}?>
                                </div>
                            <?}?>
                        </div>
<!--                    </div>-->
                <?}?>
            </div>
        </div>
    </div>
    <?}?>
</div>

<?

$js = <<<JS
        $( function() {
            $( ".mainTabs" ).tabs();
        } );

        $('.tour-stage_booking').on('click', function() {
            var popUpBlock = $('#'+$(this).attr('data-modal'));
            var tourId = popUpBlock.find('#booking-tour_id');
            var monthId = popUpBlock.find('#booking-month_id');
            var stageId = popUpBlock.find('#booking-stage_id');
            tourId.val($(this).attr('data-tour_id'));
            monthId.val($(this).attr('data-month_id'));
            stageId.val($(this).attr('data-stage_id'));
        });

JS;


$this->registerJs($js, $position = yii\web\View::POS_END, $key = null);

?>
