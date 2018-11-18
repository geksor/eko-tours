<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tour_price_section".
 *
 * @property int $tour_id
 * @property int $price_section_id
 *
 * @property PriceSection $priceSection
 * @property Tour $tour
 */
class TourPriceSection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tour_price_section';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_id', 'price_section_id'], 'required'],
            [['tour_id', 'price_section_id'], 'integer'],
            [['tour_id', 'price_section_id'], 'unique', 'targetAttribute' => ['tour_id', 'price_section_id']],
            [['price_section_id'], 'exist', 'skipOnError' => true, 'targetClass' => PriceSection::className(), 'targetAttribute' => ['price_section_id' => 'id']],
            [['tour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tour::className(), 'targetAttribute' => ['tour_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tour_id' => 'Tour ID',
            'price_section_id' => 'Price Section ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriceSection()
    {
        return $this->hasOne(PriceSection::className(), ['id' => 'price_section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tour_id']);
    }
}
