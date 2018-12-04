<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tour_attr".
 *
 * @property int $tour_id
 * @property int $attr_id
 *
 * @property Attr $attr
 * @property Tour $tour
 */
class TourAttr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tour_attr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_id', 'attr_id'], 'required'],
            [['tour_id', 'attr_id'], 'integer'],
            [['tour_id', 'attr_id'], 'unique', 'targetAttribute' => ['tour_id', 'attr_id']],
            [['attr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attr::className(), 'targetAttribute' => ['attr_id' => 'id']],
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
            'attr_id' => 'Attr ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttr()
    {
        return $this->hasOne(Attr::className(), ['id' => 'attr_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tour_id']);
    }
}
