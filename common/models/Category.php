<?php

namespace common\models;

use Yii;
use yii\helpers\Inflector;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property int $rank
 * @property int $publish
 *
 * @property CategoryTour[] $categoryTours
 * @property Tour[] $tours
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description', 'meta_description'], 'string'],
            [['rank', 'publish'], 'integer'],
            [['rank'], 'default', 'value' => 100],
            [['title', 'alias', 'meta_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название раздела',
            'alias' => 'Alias (то что после слеша в адресной строке)',
            'description' => 'Описание страницы',
            'meta_title' => 'Meta Title (то что будет в теге < title >)',
            'meta_description' => 'Meta Description',
            'rank' => 'Порядок вывода',
            'publish' => 'Публикация',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryTours()
    {
        return $this->hasMany(CategoryTour::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTours()
    {
        return $this->hasMany(Tour::className(), ['id' => 'tour_id'])->viaTable('category_tour', ['category_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CategoryQuery(get_called_class());
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
