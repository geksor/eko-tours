<footer class="footer">
    <div class = "head_cont cont">
        <div class="nav">
            <img src="/public/img/logo.svg" alt="Эко Тур">
            <?= \frontend\widgets\MenuWidget::widget() ?>
        </div>
        <div class="soc">
            <a href = "<?= array_key_exists('vk', Yii::$app->params['Contact'])?Yii::$app->params['Contact']['vk']:'' ?>" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="42" height="42" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                     viewBox="0 0 1213 1213" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <path class="fil0" d="M368 0l477 0c101,0 194,41 260,108 67,67 108,159 108,260l0 0 0 477c0,102 -41,194 -108,260 -66,67 -159,108 -260,108l0 0 -477 0c-101,0 -194,-41 -260,-108 -67,-67 -108,-159 -108,-260l0 0 0 -477c0,-101 41,-194 108,-260 67,-67 159,-108 260,-108zm477 102l-477 0c-73,0 -140,30 -188,78 -48,48 -78,115 -78,188l0 477 0 0c0,73 30,140 78,188 48,49 115,78 188,78l477 0 0 0c73,0 140,-30 188,-78 49,-48 78,-115 78,-188l0 -477 0 0c0,-73 -30,-140 -78,-188 -48,-48 -115,-78 -188,-78z"/>
                    <path id="Forma_1" class="fil0" d="M900 786c-4,1 -7,1 -11,1 -33,0 -66,0 -100,0 0,0 0,0 0,0 -4,0 -8,-1 -12,-4 -7,-6 -14,-11 -20,-17 -17,-17 -33,-33 -50,-50 -5,-5 -11,-10 -16,-14 -2,-2 -6,-4 -9,-4 0,0 0,0 -1,0 0,0 0,0 -1,0 -4,0 -8,3 -10,7 -2,4 -3,8 -3,13 -1,7 -1,15 -1,22 0,0 0,1 0,1 0,1 0,1 0,1 0,9 -1,17 -3,25 -1,4 -3,8 -5,11 -3,6 -9,9 -16,9 0,0 0,0 0,0 -29,1 -58,1 -87,-1 -6,0 -11,-2 -15,-4 -27,-13 -52,-31 -72,-52 -26,-27 -48,-55 -71,-83 -31,-38 -58,-79 -82,-121 -9,-16 -17,-32 -23,-48 -2,-5 -3,-9 -3,-14 0,-4 1,-7 2,-11 1,-2 2,-5 3,-7 2,-3 6,-5 9,-5 0,0 0,0 0,0l5 0c30,0 60,0 90,0 0,0 1,0 1,0 5,0 10,2 14,6 7,7 13,16 18,25 6,9 12,19 17,29 11,22 24,43 38,63 7,9 15,19 22,28 3,4 8,7 13,7 0,0 0,0 1,0 0,0 1,0 1,0 3,0 6,-3 6,-7 0,0 0,0 0,0l0 -105c0,0 0,0 0,-1 0,-2 0,-4 0,-6 0,-6 -5,-11 -10,-11 -3,-1 -6,-1 -8,-1 0,0 0,0 -1,0 -7,0 -12,-6 -12,-13 0,0 0,0 0,0 0,-1 -1,-3 -1,-4 0,-11 7,-20 18,-23 4,-2 9,-2 14,-2 1,0 1,0 2,0 27,0 54,0 81,0 5,0 11,-1 16,0 6,0 12,1 17,3 11,2 19,12 20,23 0,2 1,5 1,7 0,1 0,1 0,2l0 125c0,0 0,0 0,0 0,2 0,5 0,7 2,4 5,6 10,6 2,0 4,0 6,-2 17,-12 30,-29 39,-48 8,-17 15,-35 23,-53 6,-14 13,-27 19,-41 2,-4 4,-7 6,-10 2,-3 5,-4 8,-4 1,0 1,0 1,0 39,0 78,0 117,0 0,0 1,0 1,0 9,0 17,4 22,11 2,2 4,6 4,9 0,2 0,4 0,6 0,13 -3,25 -10,35 -7,12 -16,23 -25,33 -19,22 -37,44 -53,68 -4,6 -8,12 -11,19 -2,2 -2,4 -2,6 0,2 1,5 3,7 7,8 14,17 21,25 18,19 36,37 54,56 5,6 10,13 16,19 2,2 3,5 5,7 2,5 4,10 4,15 0,14 -10,27 -24,29l0 0z" data-name="Forma 1"/>
                        </svg>
            </a>
            <a href = "<?= array_key_exists('insta', Yii::$app->params['Contact'])?Yii::$app->params['Contact']['insta']:'' ?>" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42">
                    <path id="Forma_1" data-name="Forma 1" class="fil1" d="M1453.41,56h-18.82A11.6,11.6,0,0,0,1423,67.59V86.409A11.6,11.6,0,0,0,1434.59,98h18.82A11.6,11.6,0,0,0,1465,86.409V67.59A11.6,11.6,0,0,0,1453.41,56Zm7.86,30.41a7.867,7.867,0,0,1-7.86,7.864h-18.82a7.867,7.867,0,0,1-7.86-7.864V67.59a7.867,7.867,0,0,1,7.86-7.864h18.82a7.867,7.867,0,0,1,7.86,7.864V86.409h0ZM1444,66.178A10.822,10.822,0,1,0,1454.82,77,10.831,10.831,0,0,0,1444,66.178Zm0,17.918a7.1,7.1,0,1,1,7.1-7.1A7.109,7.109,0,0,1,1444,84.1Zm11.28-21.077a2.749,2.749,0,0,0-2.74,2.733A2.736,2.736,0,1,0,1455.28,63.018Z" transform="translate(-1423 -56)"/>
                </svg>
            </a>
        </div>
        <div class="phone">
            <a href="tel:<?= array_key_exists('phone', Yii::$app->params['Contact'])?Yii::$app->params['Contact']['phone']:'' ?>" style="text-decoration: none"><?= array_key_exists('phone', Yii::$app->params['Contact'])?Yii::$app->params['Contact']['phone']:'' ?></a>
        </div>
    </div>
    <div class="rosReestrWidget" style="padding: 20px 0; display: flex; align-items: center">
        <script type="text/javascript" src="https://russiatourism.ru/operators/widget/js/widget.js"></script>
        <!-- Russiatourism.ru Widget -->
        <div id="russiatourism_widget"></div>
        <script type="text/javascript">
            RT.Widget.build('%D0%A0%D0%A2%D0%9E+020279');
        </script>
    </div>
</footer><!-- .footer -->
