<?php
namespace backend\widgets;

use common\models\CallBack;
use common\models\Comment;
use yii\base\Widget;

class CountNewItemWidget extends Widget
{
    public function run()
    {
        $startDay = mktime(0,0,0);
        $endDay = mktime(23,59,59);
        $callBackToday = CallBack::find()
            ->where(['viewed' => 0])
            ->andWhere(['>', 'created_at', $startDay])
            ->andWhere(['<', 'created_at', $endDay])
            ->count();
        $callBackNotSuccessToday = CallBack::find()
            ->where(['viewed' => 1])
            ->andWhere(['>', 'created_at', $startDay])
            ->andWhere(['<', 'created_at', $endDay])
            ->count();
        $callBackOver = CallBack::find()
            ->where(['viewed' => [0,1]])
            ->andWhere(['<', 'created_at', $startDay])
            ->count();

        $reviewToday = Comment::find()
            ->where(['viewed' => 0])
            ->andWhere(['>', 'created_at', $startDay])
            ->andWhere(['<', 'created_at', $endDay])
            ->count();
        $reviewNotSuccessToday = Comment::find()
            ->where(['viewed' => 1])
            ->andWhere(['>', 'created_at', $startDay])
            ->andWhere(['<', 'created_at', $endDay])
            ->count();
        $reviewOver = Comment::find()
            ->where(['viewed' => [0,1]])
            ->andWhere(['<', 'created_at', $startDay])
            ->count();

        return $this->render('countNewItemWidget',[
            'callBackToday' => $callBackToday,
            'callBackOver' => $callBackOver,
            'callBackNotSuccessToday' => $callBackNotSuccessToday,
            'reviewToday' => $reviewToday,
            'reviewNotSuccessToday' => $reviewNotSuccessToday,
            'reviewOver' => $reviewOver
        ]);
    }
}