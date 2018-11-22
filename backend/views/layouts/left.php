<aside class="main-sidebar">

    <section class="sidebar">


        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Меню админпанели', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Запись',
                        'icon' => 'suitcase',
                        'url' => ['/booking'],
                        "active" => Yii::$app->controller->id === 'booking',
                    ],
                    [
                        'label' => 'Обратная связь',
                        'icon' => 'reply',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Обратный звонок', 'icon' => 'phone-square', 'url' => ['/call-back'], "active" => Yii::$app->controller->id === 'call-back',],
                            ['label' => 'Отзывы', 'icon' => 'comments', 'url' => ['/reviews'], "active" => Yii::$app->controller->id === 'reviews',],
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
                            [
                                'label' => 'Туры',
                                'icon' => 'globe',
                                'url' => ['/tour'],
                                "active" => Yii::$app->controller->id === 'tour'
                                    || Yii::$app->controller->id === 'month'
                                    || Yii::$app->controller->id === 'stage'
                                    || Yii::$app->controller->id === 'timetable-day'
                                    || Yii::$app->controller->id === 'timetable-item',
                            ],
                            [
                                'label' => 'Раздел цены',
                                'icon' => 'ruble-sign',
                                'url' => ['/price-section'],
                                "active" => Yii::$app->controller->id === 'price-section'
                                    || Yii::$app->controller->id === 'price-item',
                            ],
                            [
                                'label' => 'Раздел размещение',
                                'icon' => 'h-square',
                                'url' => '#',
                                'items' => [
                                   [
                                       'label' => 'Гостевые дома',
                                       'icon' => 'bed',
                                       'url' => ['/accom'],
                                       "active" => Yii::$app->controller->id === 'accom'
                                           || Yii::$app->controller->id === 'room',
                                   ],
                                   [
                                       'label' => 'Свойства номеров',
                                       'icon' => 'tags',
                                       'url' => ['/attribute'],
                                       "active" => Yii::$app->controller->id === 'attribute',
                                   ],
                                ],
                            ],
                            [
                                'label' => 'Важно знать',
                                'icon' => 'exclamation',
                                'url' => ['/know'],
                                "active" => Yii::$app->controller->id === 'know',
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
