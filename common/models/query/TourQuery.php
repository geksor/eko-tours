<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Tour]].
 *
 * @see \common\models\Tour
 */
class TourQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['publish' => 1, 'deleted' => 0]);
    }
    public function withCategories()
    {
        return $this->with([
            'categories' => function (\yii\db\ActiveQuery $query) {
                $query->active();
            }
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Tour[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Tour|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
