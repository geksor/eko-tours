<?php

namespace frontend\widgets;

use yii\helpers\VarDumper;

class InwidgetWrapper extends \yii\base\Widget
{
    public function run()
    {
        return include $_SERVER['DOCUMENT_ROOT'].'/frontend/web/inwidget/template.php';
    }
}
