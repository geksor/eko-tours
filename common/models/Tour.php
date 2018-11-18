<?php

namespace common\models;

use Imagine\Image\ImageInterface;
use Yii;
use yii\helpers\Inflector;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "tour".
 *
 * @property int $id
 * @property string $title
 * @property string $alias
 * @property string $short_description
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property int $rank
 * @property int $publish
 * @property int $hot
 *
 * @property Booking[] $bookings
 * @property Month[] $months
 * @property Reviews[] $reviews
 * @property TimetableDay[] $timetableDays
 * @property TourKnow[] $tourKnows
 * @property Know[] $knows
 * @property TourPriceItem[] $tourPriceItems
 * @property PriceItem[] $priceItems
 * @property TourPriceSection[] $tourPriceSections
 * @property PriceSection[] $priceSections
 */
class Tour extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tour';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description', 'meta_description'], 'string'],
            [['rank', 'publish', 'hot'], 'integer'],
            [['title', 'alias', 'short_description', 'meta_title'], 'string', 'max' => 255],
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
            'alias' => 'Alias',
            'short_description' => 'Short Description',
            'description' => 'Description',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'rank' => 'Rank',
            'publish' => 'Publish',
            'hot' => 'Hot',
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'tour',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@uploads') . '/images/tour',
                'url' => '/uploads/images/tour',
                'versions' => [
                    'small' => function ($img) {
                        /** @var ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new \Imagine\Image\Box(490, 490));
                    },
                    'medium' => function ($img) {
                        /** @var ImageInterface $img */
                        $dstSize = $img->getSize();
                        $maxWidth = 980;
                        if ($dstSize->getWidth() > $maxWidth) {
                            $dstSize = $dstSize->widen($maxWidth);
                        }
                        return $img
                            ->copy()
                            ->resize($dstSize);
                    },
                ]
            ],
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMonths()
    {
        return $this->hasMany(Month::className(), ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::className(), ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimetableDays()
    {
        return $this->hasMany(TimetableDay::className(), ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourKnows()
    {
        return $this->hasMany(TourKnow::className(), ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKnows()
    {
        return $this->hasMany(Know::className(), ['id' => 'know_id'])->viaTable('tour_know', ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourPriceItems()
    {
        return $this->hasMany(TourPriceItem::className(), ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriceItems()
    {
        return $this->hasMany(PriceItem::className(), ['id' => 'price_item_id'])->viaTable('tour_price_item', ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourPriceSections()
    {
        return $this->hasMany(TourPriceSection::className(), ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriceSections()
    {
        return $this->hasMany(PriceSection::className(), ['id' => 'price_section_id'])->viaTable('tour_price_section', ['tour_id' => 'id']);
    }

    /**
     * @return bool
     * For the Inflector to work, need an extension intl in php.ini
     */
    public function beforeValidate()
    {
        if (!$this->alias){
            $this->alias = $this->title;
        }

        $this->alias = Inflector::slug($this->alias);

        return parent::beforeValidate();
    }

}
