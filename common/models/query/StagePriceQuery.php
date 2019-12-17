<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\StagePrice]].
 *
 * @see \common\models\StagePrice
 */
class StagePriceQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['publish' => 1]);
    }

    public function withAccom()
    {
        return $this->with('accom');
    }

    public function orderByRank()
    {
        return $this->addOrderBy(['rank' => SORT_ASC]);
    }

    public function forPricePage()
    {
        return $this->active()->withAccom()->orderByRank();
    }

    /**
     * {@inheritdoc}
     * @return \common\models\StagePrice[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\StagePrice|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
