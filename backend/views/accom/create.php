<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Accom */

$this->title = 'Create Accom';
$this->params['breadcrumbs'][] = ['label' => 'Accoms', 'url' => ['index']];
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
