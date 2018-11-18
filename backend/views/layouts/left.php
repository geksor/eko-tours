<aside class="main-sidebar">

    <section class="sidebar">


        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Меню админпанели', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Обратная связь',
                        'icon' => 'reply',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Обратный звонок', 'icon' => 'phone-square', 'url' => ['/call-back'], "active" => Yii::$app->controller->id === 'call-back',],
                            ['label' => 'Отзывы', 'icon' => 'comments', 'url' => ['/comment'], "active" => Yii::$app->controller->id === 'comment',],
                        ],
                    ],
                    [
                        'label' => 'Настройки сайта',
                        'icon' => 'cogs',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Слайдер', 'icon' => 'images', 'url' => ['/slider'], "active" => Yii::$app->controller->id === 'slider',],
                            ['label' => 'Сертификаты', 'icon' => 'certificate', 'url' => ['/certificate'], "active" => Yii::$app->controller->id === 'certificate',],
                            ['label' => 'Документы', 'icon' => 'file-pdf', 'url' => ['/we-docs'], "active" => Yii::$app->controller->id === 'we-docs',],
                            ['label' => 'Партнеры', 'icon' => 'handshake', 'url' => ['/we-partner'], "active" => Yii::$app->controller->id === 'we-partner',],
                            ['label' => 'Сотрудники', 'icon' => 'users', 'url' => ['/personal'], "active" => Yii::$app->controller->id === 'personal',],
                            ['label' => 'Как мы работаем', 'icon' => 'wrench', 'url' =>['/how-we-work'],
                                "active" => Yii::$app->controller->id === 'how-we-work' || Yii::$app->controller->id === 'how-we-work-step',],
                            ['label' => 'Контакты', 'icon' => 'address-card', 'url' => ['/site/contact']],
                            ['label' => 'О нас на главной', 'icon' => 'info', 'url' => ['/site/about-home']],
                            ['label' => 'О нас', 'icon' => 'info', 'url' => ['/site/about-page']],
                            ['label' => 'Приемущества', 'icon' => 'thumbs-up', 'url' => ['/site/advantage']],
                        ],
                    ],
                    [
                        'label' => 'Каталог туров',
                        'icon' => 'shopping-basket',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Туры', 'icon' => 'th', 'url' => ['/tour'], "active" => Yii::$app->controller->id === 'tour',],
                            ['label' => 'Товары', 'icon' => 'archive', 'url' => ['/product'], "active" => Yii::$app->controller->id === 'product',],
                            [
                                'label' => 'Атрибуты',
                                'icon' => 'tags',
                                'url' => ['/attributes'],
                                "active" => Yii::$app->controller->id === 'attributes'
                                    || Yii::$app->controller->id === 'attr-list'
                                    || Yii::$app->controller->id === 'attr-color',
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>


    </section>

</aside>
