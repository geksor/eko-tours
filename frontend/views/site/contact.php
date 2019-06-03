<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Contact */

$this->title = $model->meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_description,
]);
$this->params['breadcrumbs'][] = $model->title?$model->title:'Контакты';
?>
<div class="pages">
    <h1 class = "h3"><?= $model->title?$model->title:'Контакты' ?></h1>
    <div class="pages_cont">
        <div class="requisites_in">
            <div class="contact">
                <ul>
                    <li>
                        <img src="/public/images/svg/map_1.svg" alt="Рябиновые бусы">
                        Адрес: <?= $model->address ?>
                    </li>
                    <li>
                        <img src="/public/images/svg/mail_1.svg" alt="Рябиновые бусы">
                        E-mail: <?= $model->email ?>
                    </li>
                    <li>
                        <img src="/public/images/svg/phone_1.svg" alt="Рябиновые бусы">
                        Тел: <?= $model->phone ?>
                    </li>
                </ul>
            </div>
            <div class="contact_map">
                <?= $model->mapScript ?>
            </div>
        </div>
    </div>
</div>

