<?php

namespace common\models;

use Imagine\Image\ImageInterface;
use Yii;
use yii\helpers\ArrayHelper;
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
 * @property array $tourPrice
 * @property int $deleted
 * @property int $min_price
 * @property int $places_count
 * @property int $city_id
 * @property string $title_add
 * @property int $max_count
 * @property string $free_field
 * @property int $show_on_home
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
 *
 * @property City $city
 * @property TourAttr[] $tourAttrs
 * @property Attr[] $attrs
 *
 * @property $selectedTourAttr
 * @property $selectAttr
 *
 */
class Tour extends \yii\db\ActiveRecord
{
    public $tourPrice = [];
    public $selectedTourAttr;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tour';
    }

    public function afterFind()
    {
        $this->tourPrice = $this->getSelectedPrice();
        $this->selectedTourAttr = $this->selectAttr;
        parent::afterFind();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'min_price', 'places_count'], 'required'],
            [['tourPrice', 'selectedTourAttr'], 'safe'],
            [['description', 'meta_description'], 'string'],
            [['rank', 'publish', 'hot', 'deleted', 'min_price', 'places_count', 'city_id', 'max_count', 'show_on_home'], 'integer'],
            [['title', 'alias', 'short_description', 'meta_title', 'title_add', 'free_field'], 'string', 'max' => 255],
            [['rank'], 'default', 'value' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'title_add' => 'Вторая часть названия',
            'alias' => 'Название в адресной строке',
            'short_description' => 'Короткое описание',
            'description' => 'Описание',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'rank' => 'Порядок вывода',
            'publish' => 'Публикация',
            'hot' => 'Горящий',
            'deleted' => 'Удален',
            'min_price' => 'Цена от',
            'places_count' => 'Мест осталось',
            'city_id' => 'Направление',
            'max_count' => 'Максимальное кол-во мест',
            'free_field' => 'Свободное поле',
            'show_on_home' => 'Показывать на главной',
            'selectedTourAttr' => 'Атрибуты',
            'tourPrice' => 'Разделы цен'
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
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    public static function getCityFromDropDown()
    {
        return ArrayHelper::map(City::find()->all(), 'id', 'title');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourAttrs()
    {
        return $this->hasMany(TourAttr::className(), ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttrs()
    {
        return $this->hasMany(Attr::className(), ['id' => 'attr_id'])->viaTable('tour_attr', ['tour_id' => 'id']);
    }

    public function getSelectAttr()
    {
        return ArrayHelper::getColumn($this->getAttrs()->select('id')->all(), 'id');
    }

    public static function getAttrFromDropDown()
    {
        return ArrayHelper::map(Attr::find()->orderBy(['attr_group_id' => SORT_ASC,'rank' => SORT_ASC])->all(), 'id', 'title', 'groupName');
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
     * @return array
     */
    public function getSelectedPrice()
    {
        $selectedAttributes = $this->getPriceSections()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedAttributes, 'id');
    }

    /**
     * @param $attrs array ([0 => attr_id, 1 => attr_id, ...])
     */
    public function saveTourAttr($attrs)
    {
        TourAttr::deleteAll(['tour_id' => $this->id]);
        if (is_array($attrs))
        {
            foreach ($attrs as $attr_id)
            {
                $attr = Attr::findOne($attr_id);
                $this->link('attrs', $attr);
            }
        }
    }

    /**
     * @param $priceSections array ([0 => $priceSections_id, 1 => $priceSections_id, ...])
     */
    public function saveTourPrice($priceSections)
    {
        TourPriceSection::deleteAll(['tour_id' => $this->id]);
        if (is_array($priceSections))
        {
            foreach ($priceSections as $priceSec_id)
            {
                $section = PriceSection::findOne($priceSec_id);
                $this->link('priceSections', $section);
            }
        }
    }

    /**
     * @param $item_id
     * @param $value
     */
    public function saveTourPriceItem($item_id, $value)
    {
        if ($link = TourPriceItem::findOne(['price_item_id' => $item_id])){
            $link->value = $value;
            $link->save(false);
        }else{
            $priceItem = PriceItem::findOne($item_id);
            $this->link('priceItems', $priceItem, ['value' => $value]);
        }
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
