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
 * @property CategoryTour[] $categoryTours
 * @property Category[] $categories
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
 * @property $selectedTourKnow
 * @property $selectKnow
 * @property $selectedTourAccom
 * @property $selectAccom
 *
 * @property TourAccom[] $tourAccoms
 * @property Accom[] $accoms
 *
 * @property array $selectCat
 * @property array $selectedCats
 * @property array $catForList
 */
class Tour extends \yii\db\ActiveRecord
{
    public $tourPrice = [];
    public $selectedTourAttr;
    public $selectedTourKnow;
    public $selectedTourAccom;

    public $selectCat;
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
        $this->selectedTourKnow = $this->selectKnow;
        $this->selectedTourAccom = $this->selectAccom;

        $this->selectCat = $this->selectedCats;
        parent::afterFind();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['selectCat'], 'safe'],
            [['title', 'min_price', 'places_count'], 'required'],
            [['tourPrice', 'selectedTourAttr', 'selectedTourKnow', 'selectedTourAccom'], 'safe'],
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
            'meta_title' => 'Title (То что будет в теге "< title >")',
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
            'tourPrice' => 'Разделы цен',
            'selectedTourKnow' => 'Разделы туристам',
            'selectedTourAccom' => 'Разделы размещение',
            'selectCat' => 'Выбор раздела'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryTours()
    {
        return $this->hasMany(CategoryTour::className(), ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('category_tour', ['tour_id' => 'id']);
    }

    /**
     * @return array
     */
    public function getSelectedCats()
    {
        $selectedCats = $this->getCategories()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedCats, 'id');
    }

    /**
     * @return array
     */
    public static function getCatForList()
    {
        return ArrayHelper::map(Category::find()->orderBy(['rank' => SORT_ASC])->all(), 'id', 'title');
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

    public function getSelectKnow()
    {
        return ArrayHelper::getColumn($this->getKnows()->select('id')->all(),'id');
    }

    public static function getKnowsFromDropDown()
    {
        return ArrayHelper::map(Know::find()->orderBy(['rank' => SORT_ASC])->all(), 'id', 'title');
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
     * @param array $cats - array [category_id, ...]
     * @param bool $clean
     * @return bool
     */
    public function saveCategories($cats, $clean = false)
    {
        if (is_array($cats)) {
            CategoryTour::deleteAll(['tour_id' => $this->id]);
            $categoryModels = Category::find()->where(['id' => $cats])->all();
            foreach ($categoryModels as $category)
            {
                $this->link('categories', $category);
            }
            return true;
        }
        if ($clean) {
            if (CategoryTour::deleteAll(['tour_id' => $this->id])){
                return true;
            }
            return false;
        }
        return false;
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
     * @param $knows array ([0 => know_id, 1 => know_id, ...])
     */
    public function saveTourKnow($knows)
    {
        TourKnow::deleteAll(['tour_id' => $this->id]);
        if (is_array($knows))
        {
            foreach ($knows as $know_id)
            {
                $know = Know::findOne($know_id);
                $this->link('knows', $know);
            }
        }
    }

    /**
     * @param $accoms array ([0 => accom_id, 1 => accom_id, ...])
     */
    public function saveTourAccom($accoms)
    {
        TourAccom::deleteAll(['tour_id' => $this->id]);
        if (is_array($accoms))
        {
            foreach ($accoms as $accom_id)
            {
                $accom = Accom::findOne($accom_id);
                $this->link('accoms', $accom);
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
    public function saveTourPriceItem($item_id, $tour_id, $value)
    {
        if ($link = TourPriceItem::findOne(['price_item_id' => $item_id, 'tour_id' => $tour_id])){
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourAccoms()
    {
        return $this->hasMany(TourAccom::className(), ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccoms()
    {
        return $this->hasMany(Accom::className(), ['id' => 'accom_id'])->viaTable('tour_accom', ['tour_id' => 'id']);
    }

    public function getSelectAccom()
    {
        return ArrayHelper::getColumn($this->getAccoms()->select('id')->all(), 'id');
    }

    public static function getAccomFromDropDown()
    {
        return ArrayHelper::map(Accom::find()->orderBy(['rank' => SORT_ASC])->all(), 'id', 'title');
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TourQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TourQuery(get_called_class());
    }

}
