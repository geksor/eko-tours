<?php

/* @var $this yii\web\View */
/* @var $model \common\models\AboutPage */
/* @var $contactModel \common\models\Contact */

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
        <?= $model->aboutText ?>
    </div>
    <div class="requisites_in">
        <div class="requisites">
            <h2 class = "h4">Реквизиты:</h2>
            <ul>
                <li>Название организации: <?= $contactModel->company_name ?></li>
                <li>ИНН: <?= $contactModel->inn ?></li>
                <li>ОГРН: <?= $contactModel->ogrn ?></li>
                <li>Сфера туроператорской деятельности: <?= $contactModel->field ?></li>
            </ul>
        </div>
        <div class="requisites">
            <h2 class = "h4">Режим работы:</h2>
            <ul>
                <li>Понедельник.........................................<?= $model->monday ?></li>
                <li>Вторник.....................................................<?= $model->tuesday ?></li>
                <li>Среда..........................................................<?= $model->wednesday ?></li>
                <li>Четверг......................................................<?= $model->thursday ?></li>
                <li>Пятница....................................................<?= $model->friday ?></li>
                <li>Суббота......................................................<?= $model->saturday ?></li>
                <li>Воскресенье...........................................<?= $model->sunday ?></li>
            </ul>
        </div>
    </div>

    <div class="pages_cont">
        <div class="requisites_in">
            <div class="contact">
                <ul>
                    <li>
                        <img src="/public/images/svg/map_1.svg" alt="Рябиновые бусы">
                        Адрес: <?= $contactModel->address ?>
                    </li>
                    <li>
                        <img src="/public/images/svg/mail_1.svg" alt="Рябиновые бусы">
                        E-mail: <?= $contactModel->email ?>
                    </li>
                    <li>
                        <img src="/public/images/svg/phone_1.svg" alt="Рябиновые бусы">
                        Тел: <?= $contactModel->phone ?>
                    </li>
                </ul>
            </div>
            <div class="contact_map">
                <?= $contactModel->mapScript ?>
            </div>
        </div>
    </div>
</div>

