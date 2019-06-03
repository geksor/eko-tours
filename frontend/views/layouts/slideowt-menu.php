<div id="menu" class="menu">
    <div class = "lefts">
        <div class = "header_menu">
            <?= \frontend\widgets\MenuWidget::widget(['ulClass' => '']) ?>
        </div>
        <div class = "header_menu">
            <h2>Эко-тур</h2>
            <!--<p>Рябиновые бусы: Адыгея Майкопский р-н п.Каменномостский, ул. Аминовская 10</p>
            <p>Горная лаванда: Адыгея Майкопский р-н п.Каменномостский, ул. Аминовская 22</p>-->
            <p>Телефон - <?= \yii\helpers\ArrayHelper::keyExists('phone', Yii::$app->params['Contact'])?Yii::$app->params['Contact']['phone']:'' ?></p>
            <p>email – <?= \yii\helpers\ArrayHelper::keyExists('email', Yii::$app->params['Contact'])?Yii::$app->params['Contact']['email']:'' ?></p>
            <!--<p>Туристская деятельность застрахована в ПАО Росгосстрах №01/35/162/00830.</p>
            <p>Собственный гостевой дом «Рябиновые бусы» ryabinovka.com, рейтинг гостевого дома на www.booking.com - 9,2 из 10 и более 200 отзывов.</p>-->
        </div>
    </div>
</div>
