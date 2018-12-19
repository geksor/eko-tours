<?

/* @var $model \common\models\Booking */

use yii\bootstrap\ActiveForm;

$css=<<< CSS
.addInput{
    display: none!important;
}
.field-callback-lastname{
    display: none!important;
}
.form-group{
    width: 100%;
}
CSS;
$this->registerCss($css, ["type" => "text/css"], "BookingWidget" );

?>

<div class="md-modal md-modal_1 md-effect-1" id="modal-tour">
    <div class="md-content">
        <h3 class="h4">Забронировать тур</h3>
        <a class="md-close">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 47.971 47.971" style="enable-background:new 0 0 47.971 47.971;" xml:space="preserve" width="512px" height="512px">
            <g>
                <path d="M28.228,23.986L47.092,5.122c1.172-1.171,1.172-3.071,0-4.242c-1.172-1.172-3.07-1.172-4.242,0L23.986,19.744L5.121,0.88   c-1.172-1.172-3.07-1.172-4.242,0c-1.172,1.171-1.172,3.071,0,4.242l18.865,18.864L0.879,42.85c-1.172,1.171-1.172,3.071,0,4.242   C1.465,47.677,2.233,47.97,3,47.97s1.535-0.293,2.121-0.879l18.865-18.864L42.85,47.091c0.586,0.586,1.354,0.879,2.121,0.879   s1.535-0.293,2.121-0.879c1.172-1.171,1.172-3.071,0-4.242L28.228,23.986z"/>
            </g>
            </svg>
        </a>
        <div>
            <?php $form = ActiveForm::begin([
                'action' => '/tours/booking'
            ]); ?>

                <div class="addInput">
                    <?= $form->field($model, 'lastName')->textInput([
                        'class' => 'addInput',
                    ])->label(false) ?>

                    <?= $form->field($model, 'tour_id')->hiddenInput()->label(false)?>
                </div>

                <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true, 'class' => 'form_text', 'placeholder' => 'Ваше имя'])->label(false) ?>

                <?= $form->field($model, 'customer_phone')->textInput(['maxlength' => true, 'class' => 'form_text', 'placeholder' => 'Ваш телефон'])->label(false) ?>

                <?= $form->field($model, 'agree')
                    ->checkbox([
                        'template' => '<div class="container_check">{input}{label}<span class="checkmark"></span><p class="help-block help-block-error"></p></div>',
                    ])
                    ->label(
                        'Контакты исключительно для связи с Вами. Никаких sms-рассылок. Управляющий позвонит лично.<br><br>
                        Оставляя ваши данные Вы соглашаетесь с <a class="agreeLink">политикой конфиденциальности</a>. Ваши контактные данные в безопасности и не будут переданы третьим лицам.'
                    )
                ?>

                <?= \yii\helpers\Html::submitButton('Забронировать', ['class' => 'zabron_read']) ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

<div class="md-modal md-modal_1 md-effect-1" id="modal-tour-stage">
    <div class="md-content">
        <h3 class="h4">Забронировать тур</h3>
        <a class="md-close">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 47.971 47.971" style="enable-background:new 0 0 47.971 47.971;" xml:space="preserve" width="512px" height="512px">
            <g>
                <path d="M28.228,23.986L47.092,5.122c1.172-1.171,1.172-3.071,0-4.242c-1.172-1.172-3.07-1.172-4.242,0L23.986,19.744L5.121,0.88   c-1.172-1.172-3.07-1.172-4.242,0c-1.172,1.171-1.172,3.071,0,4.242l18.865,18.864L0.879,42.85c-1.172,1.171-1.172,3.071,0,4.242   C1.465,47.677,2.233,47.97,3,47.97s1.535-0.293,2.121-0.879l18.865-18.864L42.85,47.091c0.586,0.586,1.354,0.879,2.121,0.879   s1.535-0.293,2.121-0.879c1.172-1.171,1.172-3.071,0-4.242L28.228,23.986z"/>
            </g>
            </svg>
        </a>
        <div>
            <?php $form = ActiveForm::begin([
                'action' => '/tours/booking'
            ]); ?>

                <div class="addInput">
                    <?= $form->field($model, 'lastName')->textInput([
                        'class' => 'addInput',
                    ])->label(false) ?>

                    <?= $form->field($model, 'tour_id')->hiddenInput()->label(false)?>

                    <?= $form->field($model, 'month_id')->hiddenInput()->label(false)?>

                    <?= $form->field($model, 'stage_id')->hiddenInput()->label(false)?>
                </div>

                <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true, 'class' => 'form_text', 'placeholder' => 'Ваше имя'])->label(false) ?>

                <?= $form->field($model, 'customer_phone')->textInput(['maxlength' => true, 'class' => 'form_text', 'placeholder' => 'Ваш телефон'])->label(false) ?>

                <?= $form->field($model, 'user_places_count')->textInput(['class' => 'form_text', 'placeholder' => 'Количество мест'])->label(false) ?>

                <?= $form->field($model, 'agree')
                    ->checkbox([
                        'template' => '<div class="container_check">{input}{label}<span class="checkmark"></span><p class="help-block help-block-error"></p></div>',
                    ])
                    ->label(
                        'Контакты исключительно для связи с Вами. Никаких sms-рассылок. Управляющий позвонит лично.<br><br>
                    Оставляя ваши данные Вы соглашаетесь с <a class="agreeLink">политикой конфиденциальности</a>. Ваши контактные данные в безопасности и не будут переданы третьим лицам.'
                    )
                ?>

                <?= \yii\helpers\Html::submitButton('Забронировать', ['class' => 'zabron_read']) ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

