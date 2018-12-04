<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Accom */

$this->title = 'Создание размещения';
$this->params['breadcrumbs'][] = ['label' => 'Размещение', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accom-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
