<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category_tour".
 *
 * @property int $category_id
 * @property int $tour_id
 *
 * @property Category $category
 * @property Tour $tour
 */
class CategoryTour extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_tour';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'tour_id'], 'required'],
            [['category_id', 'tour_id'], 'integer'],
            [['category_id', 'tour_id'], 'unique', 'targetAttribute' => ['category_id', 'tour_id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['tour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tour::className(), 'targetAttribute' => ['tour_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'tour_id' => 'Tour ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tour_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CategoryTourQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CategoryTourQuery(get_called_class());
    }
}
