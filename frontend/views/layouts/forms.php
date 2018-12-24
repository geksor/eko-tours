
<?= \frontend\widgets\CallBackWidget::widget() ?>

<?= \frontend\widgets\ReviewsFormWidget::widget() ?>

<?= \frontend\widgets\BookingWidget::widget() ?>

<div class='agreeModal'>
    <div class="md-content">
        <h3 class="h4 callBackHeader">Согласие на обработку персональных данных</h3>
        <a class="md-close agreeClose">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 47.971 47.971" style="enable-background:new 0 0 47.971 47.971;" xml:space="preserve" width="512px" height="512px">
            <g>
                <path d="M28.228,23.986L47.092,5.122c1.172-1.171,1.172-3.071,0-4.242c-1.172-1.172-3.07-1.172-4.242,0L23.986,19.744L5.121,0.88   c-1.172-1.172-3.07-1.172-4.242,0c-1.172,1.171-1.172,3.071,0,4.242l18.865,18.864L0.879,42.85c-1.172,1.171-1.172,3.071,0,4.242   C1.465,47.677,2.233,47.97,3,47.97s1.535-0.293,2.121-0.879l18.865-18.864L42.85,47.091c0.586,0.586,1.354,0.879,2.121,0.879   s1.535-0.293,2.121-0.879c1.172-1.171,1.172-3.071,0-4.242L28.228,23.986z"/>
            </g>
            </svg>
        </a>

        <?= \frontend\widgets\AgreeTextWidget::widget() ?>
        <div class="modal-footer">
            <button type="button" class="zabron_read agreeClose">OK</button>
        </div>

    </div>
</div>


<div class="md-modal md-modal_1 md-effect-1 <?= Yii::$app->session->hasFlash('popUp')?'md-show':'' ?>" id="popUp_mess">
    <div class="md-content" style="padding-bottom: 30px">
        <h3 class="h4"><?= Yii::$app->session->getFlash('popUp') ?></h3>
        <a class="zabron_read" onclick="$('#popUp_mess').removeClass('md-show')">OK</a>
    </div>
</div>

<?

$js = <<<JS
    $('.agreeLink').on('click', function() {
        $('.agreeModal').show('fade', 300);
    });
    $('.agreeClose').on('click', function() {
        $('.agreeModal').hide('fade', 300);
    });
    $('.checkmark').on('click', function() {
        $(this).siblings('label').trigger('click');
    });
JS;


$this->registerJs($js, $position = yii\web\View::POS_END, $key = null);

?>
