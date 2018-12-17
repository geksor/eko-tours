<?

/* @var $cityModels \common\models\City */
/* @var $attrModels \common\models\Attr */

?>

<? if ($cityModels) {?>
    <div class="head_nap">
        <h2>Направления</h2>
        <ul>
            <? foreach ($cityModels as $cityModel) {/* @var $cityModel \common\models\City */?>
                <li>
                    <?= \yii\helpers\Html::a($cityModel->title, ['/tours', 'city_id' => $cityModel->id]) ?>
                </li>
            <?}?>
        </ul>
    </div>
<?}?>
<? if ($attrModels) {?>
    <div class="head_nap">
    <h2>Тип отдыха</h2>
    <ul>
        <? foreach ($attrModels as $attrModel) {/* @var $attrModel \common\models\Attr */?>
            <li>
                <?= \yii\helpers\Html::a($attrModel->title, ['/tours', 'attr_id' => $attrModel->id]) ?>
            </li>
        <?}?>
    </ul>
</div>
<?}?>