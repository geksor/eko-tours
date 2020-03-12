<?php

use \yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \common\models\Tour */
/* @var $models \common\models\Accom */
///* @var $pageParamsTours \common\models\ToursPage */
/* @var $category \common\models\Category */
/* @var $stageModels \common\models\Stage */
/* @var $stage \common\models\Stage */
/* @var $stageAccoms \common\models\Accom */
/* @var $accom \common\models\Accom */
/* @var $stagePrices \common\models\StagePrice */
/* @var $stagePrice \common\models\StagePrice */

$this->title = $model->meta_title;
$this->registerMetaTag([
    'name'    => 'description',
    'content' => $model->meta_description,
]);
$this->params['breadcrumbs'][] = ['label' => $category->title, 'url' => ["/tours/$category->alias"]];
$this->params['breadcrumbs'][] = ['label' => $tour->title, 'url' => ["/tours/$category->alias/$tour->alias"]];
$this->params['breadcrumbs'][] = $room->title. ' ('.date('d.m.Y',strtotime($period->start)). '-'.date('d.m.Y',strtotime($period->end)).')';

?>
<?= $room->title ?><br>
<?= date('d.m.Y',strtotime($period->start)) ?><br>
<?= date('d.m.Y',strtotime($period->end)) ?><br>

<? if ($price) { ?>
  &nbsp;- <strong><?= $price ?> руб.</strong>
<? } else { ?>
  Цена: Подробности по телефону
<? } ?>

<?= $room->description ?><br>

  <a class="md-trigger zabron_read bron_click bron_click_1 tour_booking" data-modal="modal-tour" data-tour_id="<?= $tour->id ?>" data-room_id="<?= $room->id ?>" data-period_id="<?= $period->id ?>">Забронировать в 1 клик</a>

<? $images = $room->getBehavior('galleryBehavior')->getImages() ?>
  <div class="tour_in_img_1">
      <? if ($images) { ?>
          <? foreach ($images as $image) { ?>
              <a href="<?= $image->getUrl('original') ?>" class="gall_link" data-fancybox="gallery-main">
                <img src="<?= $image->getUrl('medium') ?>" alt="<?= $image->name ?>">
              </a>
              <?
          } ?>
      <? } ?>
  </div>

  <div class="md-modal md-modal_1 md-effect-1" id="modal-tour-room">
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
            <?= $form->field($booking, 'lastName')->textInput([
                'class' => 'addInput',
            ])->label(false) ?>

            <?= $form->field($booking, 'tour_id')->hiddenInput()->label(false)?>

            <?= $form->field($booking, 'tour_period_room_id')->hiddenInput()->label(false)?>
        </div>

          <?= $form->field($booking, 'customer_name')->textInput(['maxlength' => true, 'class' => 'form_text', 'placeholder' => 'Ваше имя'])->label(false) ?>

          <?= $form->field($booking, 'customer_phone')->textInput(['maxlength' => true, 'class' => 'form_text', 'placeholder' => 'Ваш телефон'])->label(false) ?>

          <?= $form->field($booking, 'agree')
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