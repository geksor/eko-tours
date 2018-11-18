<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tour_know".
 *
 * @property int $tour_id
 * @property int $know_id
 *
 * @property Know $know
 * @property Tour $tour
 */
class TourKnow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tour_know';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_id', 'know_id'], 'required'],
            [['tour_id', 'know_id'], 'integer'],
            [['tour_id', 'know_id'], 'unique', 'targetAttribute' => ['tour_id', 'know_id']],
            [['know_id'], 'exist', 'skipOnError' => true, 'targetClass' => Know::className(), 'targetAttribute' => ['know_id' => 'id']],
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
            'know_id' => 'Know ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKnow()
    {
        return $this->hasOne(Know::className(), ['id' => 'know_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tour_id']);
    }
}
