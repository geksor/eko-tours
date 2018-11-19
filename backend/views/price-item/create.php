<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PriceItem */

$this->title = 'Create Price Item';
$this->params['breadcrumbs'][] = ['label' => 'Price Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-item-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
