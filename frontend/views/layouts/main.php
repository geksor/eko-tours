<?php

/* @var $this \frontend\components\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script><![endif]-->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - Эко-Тур</title>
    <?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper panel" id="panel">

    <?= $this->render('header') ?>

    <main class="content<? if (Yii::$app->request->url !== Yii::$app->homeUrl) {?> cont <?}?>" data-slideout-ignore>

        <? if (Yii::$app->request->url !== Yii::$app->homeUrl) {?>

            <div class="breads">
                <?= Breadcrumbs::widget(
                    [
                        'itemTemplate' => '<li>{link}</li>',
                        'activeItemTemplate' => '<li>{link}</li>',
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]
                ) ?>
            </div>

        <?}?>

        <?= $content ?>
    </main>

</div>

<?= $this->render('slideowt-menu') ?>

<?= $this->render('footer') ?>

<?= $this->render('forms') ?>

<button id="buttonUp" class="buttonUp active">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
        <path d="M240.971 130.524l194.343 194.343c9.373 9.373 9.373 24.569 0 33.941l-22.667 22.667c-9.357 9.357-24.522 9.375-33.901.04L224 227.495 69.255 381.516c-9.379 9.335-24.544 9.317-33.901-.04l-22.667-22.667c-9.373-9.373-9.373-24.569 0-33.941L207.03 130.525c9.372-9.373 24.568-9.373 33.941-.001z"></path>
    </svg>
</button>

<?
$css=<<< CSS
#buttonUp{
  display: none;
  z-index: 10;
  background: #000000;
  width: 40px;
  height: 40px;
  border-radius: 4px;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  position: fixed;
  bottom: -100px;
  left: 10px;
  -webkit-transition: all .3s ease-in-out;
  -moz-transition: all .3s ease-in-out;
  -o-transition: all .3s ease-in-out;
  -ms-transition: all .3s ease-in-out;
  transition: all .3s ease-in-out;
  overflow: hidden;
  opacity: .7;
  cursor: pointer;
  outline: none;
  border: none;
}
#buttonUp:hover{
  opacity: 1;
}
#buttonUp svg{
  top: 1px;
  position: relative;
}
#buttonUp svg path{
  fill: #ffffff;
}
#buttonUp.active{
  bottom: 50px;
}
CSS;

$this->registerCss($css, ["type" => "text/css"], "buttonUp" );

$js = <<< JS
$(window).scroll(function () {
    if ($(this).scrollTop() > 200) {
        $('#buttonUp').fadeIn().addClass('active');
    } else {
        $('#buttonUp').fadeOut().removeClass('active');
    }
});

$('#buttonUp').click(function () {
    $('body,html').animate({
        scrollTop: 0
    }, 500);
    return false;
});

    window.onload = function() {
        var slideout = new Slideout({
            'panel': document.getElementById('panel'),
            'menu': document.getElementById('menu'),
            'side': 'left'
        });

        document.querySelector('.js-slideout-toggle').addEventListener('click', function() {
            slideout.toggle();
        });

        document.querySelector('.menu').addEventListener('click', function(eve) {
            if (eve.target.nodeName === 'A') { slideout.close(); }
        });
        function close(eve) {
            eve.preventDefault();
            slideout.close();
        }

        slideout
            .on('beforeopen', function() {
                this.panel.classList.add('panel-open');
            })
            .on('open', function() {
                this.panel.addEventListener('click', close);
            })
            .on('beforeclose', function() {
                this.panel.classList.remove('panel-open');
                this.panel.removeEventListener('click', close);
            });
    };
    
    
    $('.slider2').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            700:{
                items:2
            }
        }
    });
    $('.slider3').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            700:{
                items:2
            },

            1000:{
                items:4
            }
        }
    });
    $('.slider4').owlCarousel({
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


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
