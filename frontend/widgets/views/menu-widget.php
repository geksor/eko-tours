<?

/* @var $items \frontend\widgets\MenuWidget */


?>

<?= \yii\widgets\Menu::widget([
    'items' => [
        ['label' => 'ТУРЫ', 'url' => [ '/tours' ], 'active' => Yii::$app->controller->id === 'tours'],
        ['label' => 'РАСПИСАНИЕ ТУРОВ', 'url' => [ '/site/timetable' ]],
        ['label' => 'ТУРИСТАМ', 'url' => [ '/site/tourist' ]],
        ['label' => 'О НАС', 'url' => [ '/site/about' ]],
        ['label' => 'КОНТАКТЫ', 'url' => [ '/site/contact' ]],
    ],
    'options' => [
        'class' => 'head_menu',
    ],
]) ?>
