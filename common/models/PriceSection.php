<?php

namespace common\models;

use common\behaviors\ImgUploadBehavior;
use Yii;

/**
 * This is the model class for table "price_section".
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property int $rank
 *
 * @property PriceItem[] $priceItems
 * @property TourPriceSection[] $tourPriceSections
 * @property Tour[] $tours
 */
class PriceSection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price_section';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rank'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            [['rank'], 'default', 'value' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'image' => 'Image',
            'rank' => 'Rank',
        ];
    }

    public function behaviors()
    {
        return [
            'ImgUploadBehavior' => [
                'class' => ImgUploadBehavior::className(),
                'noImage' => 'no_image.png',
                'folder' => '/uploads/images/price-section',
                'propImage' => 'image',
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriceItems()
    {
        return $this->hasMany(PriceItem::className(), ['price_section_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourPriceSections()
    {
        return $this->hasMany(TourPriceSection::className(), ['price_section_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTours()
    {
        return $this->hasMany(Tour::className(), ['id' => 'tour_id'])->viaTable('tour_price_section', ['price_section_id' => 'id']);
    }
}
