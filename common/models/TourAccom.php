<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tour_accom".
 *
 * @property int $tour_id
 * @property int $accom_id
 *
 * @property Accom $accom
 * @property Tour $tour
 */

class TourAccom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tour_accom';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_id', 'accom_id'], 'required'],
            [['tour_id', 'accom_id'], 'integer'],
            [['tour_id', 'accom_id'], 'unique', 'targetAttribute' => ['tour_id', 'accom_id']],
            [['accom_id'], 'exist', 'skipOnError' => true, 'targetClass' => Accom::className(), 'targetAttribute' => ['accom_id' => 'id']],
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
            'accom_id' => 'Accom ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccom()
    {
        return $this->hasOne(Accom::className(), ['id' => 'accom_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tour_id']);
    }
}
