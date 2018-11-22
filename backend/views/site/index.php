<?php

/* @var $this yii\web\View */
/* @var $counter_direct */
/* @var $counter_search */
/* @var $counter_ads */
/* @var $counter_inner */
/* @var $labelsChart */
/* @var $dataChart */

use yii\helpers\Html;

$this->title = 'Эко-Тур панель администратора';
?>
<div class="site-index container-fluid">
    <p>
        <?= Html::a('Панель статистики', ['/dashboard'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-aqua"><i class="fa fa-arrow-right"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Прямые переходы</span>
                    <span class="info-box-number"><?= $counter_direct ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-green"><i class="fa fa-undo"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Переходы внутри <br> сайта</span>
                    <span class="info-box-number"><?= $counter_inner ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-yellow"><i class="fa fa-search"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">По поисковым <br> запросам</span>
                    <span class="info-box-number"><?= $counter_search ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-red"><i class="fa fa-exclamation-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Рекламные ссылки</span>
                    <span class="info-box-number"><?= $counter_ads ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Источники перехода</h3>
                </div>
                <div class="box-body">
                    <div class="position-relative">
                        <canvas id="sours" style="height: 40vh;width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Статистика по браузерам</h3>
                </div>
                <div class="box-body">
                    <div class="position-relative">
                        <canvas id="browser" style="height: 40vh;width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?

$js = <<< JS
    $(document).ready(function (){
        var ctx = $("#sours");
        var sours = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Прямые переходы", "По поисковым запросам", "Рекламные ссылки"],
                datasets: [{
                    data: ["$counter_direct", "$counter_search", "$counter_ads"],
                    backgroundColor: [
                        '#00c0ef',
                        '#f39c12',
                        '#dd4b39',
                    ],
                }]
            },
            options: {
            }
        });
        var ctx1 = $("#browser");
        var browser = new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: $labelsChart,
                datasets: [{
                    data: $dataChart,
                    backgroundColor: [
                        '#00b864',
                        '#558ff3',
                        '#c77fdd',
                        '#00c0ef',
                        '#f39c12',
                        '#dd4b39',
                    ],

                }]
            },
            options: {
            }
        });
    });
JS;

$this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
?>
