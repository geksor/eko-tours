<?

/* @var $items \frontend\widgets\MenuWidget */
/* @var $ulClass */

?>

<?= \yii\widgets\Menu::widget([
    'items' => [
//        ['label' => 'ТУРЫ', 'url' => [ '/tours' ], 'active' => Yii::$app->controller->id === 'tours'],
        ['label' => 'РАСПИСАНИЕ ТУРОВ', 'url' => [ '/site/timetable' ]],
        ['label' => 'ТУРИСТАМ', 'url' => [ '/site/tourist' ]],
//        ['label' => 'О НАС', 'url' => [ '/site/about' ]],
        ['label' => 'КОНТАКТЫ', 'url' => [ '/site/about' ]],
    ],
    'options' => [
        'class' => $ulClass,
    ],
]) ?>
