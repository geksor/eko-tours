<?

/* @var $callBackToday \frontend\widgets\CallBackWidget */
/* @var $callBackOver \frontend\widgets\CallBackWidget */
/* @var $callBackNotSuccessToday \frontend\widgets\CallBackWidget */
/* @var $reviewToday \frontend\widgets\CallBackWidget */
/* @var $reviewNotSuccessToday \frontend\widgets\CallBackWidget */
/* @var $reviewOver \frontend\widgets\CallBackWidget */

$totalAlert = $callBackToday + $callBackOver + $callBackNotSuccessToday + $reviewToday + $reviewNotSuccessToday + $reviewOver;

?>

<!-- Messages: style can be found in dropdown.less-->
<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="far fa-bell"></i>
        <? if ($totalAlert > 0) {?>
            <span class="label label-warning"><?= $totalAlert ?></span>
        <?}?>
    </a>
    <? if ($totalAlert > 0) {?>
    <ul class="dropdown-menu">
        <li class="header">У вас <?= $totalAlert ?> уведомлений</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                <? if ($callBackToday) {?>
                <li>
                    <a href="/admin/call-back">
                        <i class="fas fa-phone-square text-aqua"></i> <?= $callBackToday ?> новых заявок на звонок сегодня
                    </a>
                </li>
                <?}?>
                <? if ($callBackNotSuccessToday) {?>
                <li>
                    <a href="/admin/call-back">
                        <i class="fas fa-phone-square text-yellow"></i> <?= $callBackNotSuccessToday ?> не обработанных заявок сегодня
                    </a>
                </li>
                <?}?>
                <? if ($callBackOver) {?>
                <li>
                    <a href="/admin/call-back">
                        <i class="fas fa-phone-square text-red"></i> <?= $callBackOver ?> просроченных заявок на звонок
                    </a>
                </li>
                <?}?>
                <? if ($reviewToday) {?>
                <li>
                    <a href="/admin/comment">
                        <i class="far fa-comments text-aqua"></i> <?= $reviewToday ?> новых отзывов сегодня
                    </a>
                </li>
                <?}?>
                <? if ($reviewNotSuccessToday) {?>
                <li>
                    <a href="/admin/comment">
                        <i class="far fa-comments text-yellow"></i> <?= $reviewNotSuccessToday ?> не обработанных отзывов сегодня
                    </a>
                </li>
                <?}?>
                <? if ($reviewOver) {?>
                <li>
                    <a href="/admin/comment">
                        <i class="far fa-comments text-red"></i> <?= $reviewOver ?> не обработанных отзывов
                    </a>
                </li>
                <?}?>

            </ul>
        </li>
    </ul>
    <?}?>
</li>

