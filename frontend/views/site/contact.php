<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Contact */

$this->title = $model->title;
$this->registerMetaTag([
    'name' => 'title',
    'content' => $model->meta_title,
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_description,
]);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages">
    <h1 class = "h3"><?= $this->title ?></h1>
    <div class="pages_cont">
        <div class="requisites_in">
            <div class="contact">
                <ul>
                    <li>
                        <img src="/public/images/svg/map_1.svg" alt="Рябиновые бусы">
                        Рябиновые бусы: Адыгея Майкопский<br>р-н <?= $model->address_beads ?>
                    </li>
                    <li>
                        <img src="/public/images/svg/map_1.svg" alt="Горная лаванда">
                        Горная лаванда: Адыгея Майкопский<br>р-н <?= $model->address_lavender ?>
                    </li>
                    <li>
                        <img src="/public/images/svg/mail_1.svg" alt="Рябиновые бусы">
                        E-mail: <?= $model->email ?>
                    </li>
                    <li>
                        <img src="/public/images/svg/phone_1.svg" alt="Рябиновые бусы">
                        <?= $model->phone ?>
                    </li>
                </ul>
            </div>
            <div class="contact_map">
                <?= $model->mapScript ?>
            </div>
        </div>
    </div>
</div>

