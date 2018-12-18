
<?= \frontend\widgets\CallBackWidget::widget() ?>

<?= \frontend\widgets\ReviewsFormWidget::widget() ?>

<?= \frontend\widgets\BookingWidget::widget() ?>

<div class="md-modal md-modal_1 md-effect-1 <?= Yii::$app->session->hasFlash('popUp')?'md-show':'' ?>" id="popUp_mess">
    <div class="md-content" style="padding-bottom: 30px">
        <h3 class="h4"><?= Yii::$app->session->getFlash('popUp') ?></h3>
        <a class="zabron_read" onclick="$('#popUp_mess').removeClass('md-show')">OK</a>
    </div>
</div>

