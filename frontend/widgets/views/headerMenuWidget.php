<?

/* @var $items \frontend\widgets\HeaderMenuWidget */


?>

<div class="collapse navbar-collapse" id="navbarText">

    <?= \yii\widgets\Menu::widget([
        'items' => [
            [
                'label' => 'Наши услуги',
                'options' => ['class' => 'nav-item mx-1 pt-3 pt-lg-2 weService'],
                'template' => '<span class="nav-link text-center px-0 noneClose" style="cursor: pointer">{label}&nbsp;<i class="fas fa-chevron-down"></i></span>',
            ],
            ['label' => 'Партнеры', 'url' => [ '/site/partner' ]],
            ['label' => 'Документы', 'url' => [ '/site/documents' ]],
            ['label' => 'Отзывы', 'url' => [ '/site/reviews' ]],
            ['label' => 'О компании', 'url' => [ '/site/about' ]],
            ['label' => 'Контакты', 'url' => [ '/site/contact' ]],
        ],
        'options' => [
            'class' => 'navbar-nav justify-content-between w-100 mt-4 mt-lg-0',
        ],
        'linkTemplate' => '<a class="nav-link text-center px-0" href="{url}">{label}</a>',
        'itemOptions'=>['class'=>'nav-item mx-1 pt-3 pt-lg-2'],
    ]) ?>

</div>
