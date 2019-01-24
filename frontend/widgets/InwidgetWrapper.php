<?php

namespace frontend\widgets;

use yii\helpers\VarDumper;

class InwidgetWrapper extends \yii\base\Widget
{
    public function run()
    {
        VarDumper::dump($_SERVER['DOCUMENT_ROOT'], 10, true);
        return include $_SERVER['DOCUMENT_ROOT'].'/frontend/web/inwidget/template.php';
    }
}
