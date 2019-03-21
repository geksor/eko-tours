<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "attr".
 *
 * @property int $id
 * @property int $attr_group_id
 * @property string $title
 * @property int $rank
 * @property int $groupName
 *
 * @property AttrGroup $attrGroup
 * @property TourAttr[] $tourAttrs
 * @property Tour[] $tours
 * @property Tour[] $toursPublish
 */
class Attr extends \yii\db\ActiveRecord
{
    public $groupName;

    public function afterFind()
    {
        if ($attrGroup = $this->attrGroup){
            $this->groupName = $attrGroup->title;
        }
        parent::afterFind();
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attr_group_id'], 'required'],
            [['attr_group_id', 'rank'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['attr_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => AttrGroup::className(), 'targetAttribute' => ['attr_group_id' => 'id']],
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
            'attr_group_id' => 'Группа',
            'title' => 'Название',
            'rank' => 'Порядок вывода',
        ];
    }

    public static function getAttrGroupFromDropDown()
    {
        return ArrayHelper::map(AttrGroup::find()->all(), 'id', 'title');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttrGroup()
    {
        return $this->hasOne(AttrGroup::className(), ['id' => 'attr_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourAttrs()
    {
        return $this->hasMany(TourAttr::className(), ['attr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTours()
    {
        return $this->hasMany(Tour::className(), ['id' => 'tour_id'])->viaTable('tour_attr', ['attr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToursPublish()
    {
        return $this
            ->hasMany(Tour::className(), ['id' => 'tour_id'])->viaTable('tour_attr', ['attr_id' => 'id'])
            ->where(['publish' => 1]);
    }
}
