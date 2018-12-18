<?php
namespace frontend\widgets;

use yii\base\Widget;

class MenuWidget extends Widget
{
    public $ulClass = 'head_menu';

    public function run()
    {

        return $this->render('menu-widget', [
            'ulClass' => $this->ulClass,
        ]);
    }
}