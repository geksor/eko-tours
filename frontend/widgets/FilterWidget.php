<?php
namespace frontend\widgets;

use common\models\Attr;
use common\models\City;
use yii\base\Widget;

class FilterWidget extends Widget
{
    public function run()
    {

        $cityModels = City::find()->orderBy(['rank' => SORT_ASC])->with('tours')->all();
        $attrModels = Attr::find()->orderBy(['rank' => SORT_ASC])->with('tours')->all();

        return $this->render('filter-widget', [
            'cityModels' => $cityModels,
            'attrModels' => $attrModels,
        ]);
    }
}