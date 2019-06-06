<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Category]].
 *
 * @see \common\models\Category
 */
class CategoryQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['publish' => 1]);
    }

    public function whereAlias($alias)
    {
        return $this->andWhere(['alias' => $alias]);
    }
    public function withTours()
    {
        return $this->with([
            'tours' => function (\yii\db\ActiveQuery $query) {
                $query->active()->orderBy(['rank' => SORT_ASC]);
            },
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Category[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Category|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
