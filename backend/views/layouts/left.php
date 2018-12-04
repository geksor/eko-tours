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
                            ['label' => 'Галлереи', 'icon' => 'images', 'url' => ['/gallery'], "active" => Yii::$app->controller->id === 'gallery',],
                            ['label' => 'Домашняя страница', 'icon' => 'home', 'url' => ['/site/home-page']],
                            ['label' => 'Страница Туры', 'icon' => 'ticket-alt', 'url' => ['/site/tours-page']],
                            ['label' => 'Страница Размещение', 'icon' => 'ticket-alt', 'url' => ['/site/accom-page']],
                            ['label' => 'Контакты', 'icon' => 'address-card', 'url' => ['/site/contact']],
                            ['label' => 'Страница размещение', 'icon' => 'bed', 'url' => ['site/comm-page']],
                            ['label' => 'Страница расписание', 'icon' => 'clock', 'url' => ['site/timetable-page']],
                            ['label' => 'Страница О нас', 'icon' => 'info', 'url' => ['/site/about-page']],
                            ['label' => 'Страница Туристам', 'icon' => 'info', 'url' => ['/site/tourist-page']],
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
                                'label' => 'Направления',
                                'icon' => 'globe',
                                'url' => ['/city'],
                                "active" => Yii::$app->controller->id === 'city',
                            ],
                            [
                                'label' => 'Атрибуты туров',
                                'icon' => 'globe',
                                'url' => '#',
                                'items' => [
                                    [
                                      'label' => 'Группы атрибутов',
                                      'icon' => 'globe',
                                      'url' => ['/attr-group'],
                                      'active' => Yii::$app->controller->id === 'attr-group',
                                    ],
                                    [
                                      'label' => 'Атрибуты',
                                      'icon' => 'globe',
                                      'url' => ['/attr'],
                                      'active' => Yii::$app->controller->id === 'attr',
                                    ],
                                ],
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
                                'label' => 'Туристам',
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
