<?

/* @var $cityModels \common\models\City */
/* @var $attrModels \common\models\Attr */
/* @var $categories \common\models\Category[] */

?>

<?// if ($cityModels) {?>
<!--    <div class="head_nap">-->
<!--        <h2>Направления</h2>-->
<!--        <ul>-->
<!--            --><?// foreach ($cityModels as $cityModel) {/* @var $cityModel \common\models\City */?>
<!--                --><?// if ($cityModel->tours) {?>
<!--                    <li>-->
<!--                        --><?//= \yii\helpers\Html::a($cityModel->title, ['/tours', 'city_id' => $cityModel->id]) ?>
<!--                    </li>-->
<!--                --><?//}?>
<!--            --><?//}?>
<!--        </ul>-->
<!--    </div>-->
<?//}?>
<?// if ($attrModels) {?>
<!--    <div class="head_nap">-->
<!--    <h2>Разделы</h2>-->
<!--    <ul>-->
<!--        --><?// foreach ($attrModels as $attrModel) {/* @var $attrModel \common\models\Attr */?>
<!--            --><?// if ($attrModel->tours) {?>
<!--                <li>-->
<!--                    --><?//= \yii\helpers\Html::a($attrModel->title, ['/tours', 'attr_id' => $attrModel->id]) ?>
<!--                </li>-->
<!--            --><?//}?>
<!--        --><?//}?>
<!--    </ul>-->
<!--</div>-->
<?//}?>

<? if ($categories) {?>
    <div class="head_nap">
    <h2>Разделы</h2>
    <ul>
        <? foreach ($categories as $category) {?>
            <? if ($category->tours) {?>
                <li>
                    <?= \yii\helpers\Html::a($category->title, ["/tours/$category->alias"]) ?>
                </li>
            <?}?>
        <?}?>
    </ul>
</div>
<?}?>