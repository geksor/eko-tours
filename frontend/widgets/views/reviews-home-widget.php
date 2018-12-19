<?

/* @var $items \frontend\widgets\MenuWidget */
/* @var $models \common\models\Reviews */

?>

<div class="reviews">
    <div class = "cont">
        <h2 class = "h2">Отзывы наших туристов</h2>
        <div class="slider4 owl-carousel owl-theme">
            <? if ($models) {?>
                <? foreach ($models as $model) {/* @var $model \common\models\Reviews */?>
                    <div class="review item">
                        <h3><?= $model->user_name ?></h3>
                        <p class = "date"><?= Yii::$app->formatter->asDate($model->create_at, 'long') ?></p>
                        <p class="review_p">
                            <?= $model->text ?>
                        </p>
                    </div>
                <?}?>
            <?}?>
        </div>
    </div>
    <a class="md-trigger review_read" data-modal="reviews">Написать отзыв</a>
</div>
