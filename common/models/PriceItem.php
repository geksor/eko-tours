<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "price_item".
 *
 * @property int $id
 * @property int $price_section_id
 * @property string $text
 * @property int $rank
 *
 * @property PriceSection $priceSection
 * @property TourPriceItem[] $tourPriceItems
 * @property Tour[] $tours
 */
class PriceItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price_section_id'], 'required'],
            [['price_section_id', 'rank'], 'integer'],
            [['text'], 'string'],
            [['price_section_id'], 'exist', 'skipOnError' => true, 'targetClass' => PriceSection::className(), 'targetAttribute' => ['price_section_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'price_section_id' => 'Price Section ID',
            'text' => 'Text',
            'rank' => 'Rank',
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
    public function getTourPriceItems()
    {
        return $this->hasMany(TourPriceItem::className(), ['price_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTours()
    {
        return $this->hasMany(Tour::className(), ['id' => 'tour_id'])->viaTable('tour_price_item', ['price_item_id' => 'id']);
    }

    public function getValue($tour_id)
    {
        return TourPriceItem::find()->where(['price_item_id' => $this->id, 'tour_id' => $tour_id])->one()->value;
    }
}
