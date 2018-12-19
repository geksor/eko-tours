<?php
use yii\helpers\Html;
$css=<<< CSS
.main-header .sidebar-toggle:before {
    content: none;
}
CSS;
$this->registerCss($css, ["type" => "text/css"], "callBackWidget" );
/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">ЭТ</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="fas fa-bars"></span>
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

<!--                --><?//= \backend\widgets\CountNewItemWidget::widget() ?>

                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <?= Html::a('Выход', ['site/logout'], ['data'=>['method'=>'post'] ,'class'=>'btn btn-primary btn-flat']) ?>
                </li>
            </ul>
        </div>
    </nav>
</header>
