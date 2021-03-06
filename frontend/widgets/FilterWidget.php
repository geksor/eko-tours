<?php
namespace frontend\widgets;

use common\models\Attr;
use common\models\Category;
use common\models\City;
use yii\base\Widget;

class FilterWidget extends Widget
{
    public function run()
    {

//        $cityModels = City::find()->orderBy(['rank' => SORT_ASC])->with('tours')->all();
//        $attrModels = Attr::find()->orderBy(['rank' => SORT_ASC])->with('tours')->all();
        $categories = Category::find()->active()->orderBy(['rank' => SORT_ASC])->all();

        return $this->render('filter-widget', [
//            'cityModels' => $cityModels,
//            'attrModels' => $attrModels,
            'categories' => $categories,
        ]);
    }
}