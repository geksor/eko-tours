<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TourPeriod */

$this->title = 'от '.$model->start.' до '.$model->end;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Периоды'), 'url' => ['index', 'tour_id' => $model->tour_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="month-view">

  <div class="box box-primary">
    <div class="box-body">

      <p>
          <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['index', 'tour_id' => $model->tour_id], ['class' => 'btn btn-default']) ?>
          <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?></p>

        <?= DetailView::widget([
            'model'      => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'tour_id',
                    'value'     => function ($data) {
                        /* @var $data \common\models\Month */
                        return $data->tour->title;
                    },
                ],
                start,
                end,
                [
                    'attribute' => 'publish',
                    'label'     => 'Состояние',
                    'value'     => function ($data) {
                        /* @var $data \common\models\Month */
                        if ($data->publish) {
                            return 'Опубликован';
                        }
                        return 'Не опубликован';
                    },
                ],
            ],
        ]) ?>

      <br>
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Номера и цены</h3>
        </div>
        <div class="box-body">
          <table id="w0" class="table table-striped table-bordered detail-view">
            <tbody>
            <?php
            foreach ($rooms["accoms"] as $key => $row) {
              echo '<tr><th>'.$row.'</th><td>';
                if ($rooms["rooms"][$key]) {
                    foreach ($rooms["rooms"][$key] as $rowRoom) {
                      if($rowRoom["price"]) {
                          echo '<strong>'.$rowRoom["title"].'</strong>: '.$rowRoom["price"].' руб. <br>';
                      }else{
                          echo '<strong>'.$rowRoom["title"].'</strong>: цена не указана.<br>';
                      }
                    }
                } else {
                    echo 'В данном гостевом доме нет комнат.';
                }
            echo '</td></tr>';
            }
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>

</div>
