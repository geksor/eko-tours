<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tour_price_item".
 *
 * @property int $tour_id
 * @property int $price_item_id
 * @property string $value
 *
 * @property PriceItem $priceItem
 * @property Tour $tour
 */
class TourPriceItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tour_price_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_id', 'price_item_id'], 'required'],
            [['tour_id', 'price_item_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['tour_id', 'price_item_id'], 'unique', 'targetAttribute' => ['tour_id', 'price_item_id']],
            [['price_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => PriceItem::className(), 'targetAttribute' => ['price_item_id' => 'id']],
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
            'price_item_id' => 'Price Item ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriceItem()
    {
        return $this->hasOne(PriceItem::className(), ['id' => 'price_item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tour_id']);
    }
}
