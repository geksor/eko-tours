<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "timetable_day".
 *
 * @property int $id
 * @property int $tour_id
 * @property int $day_number
 *
 * @property Tour $tour
 * @property TimetableItem[] $timetableItems
 */
class TimetableDay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'timetable_day';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_id'], 'required'],
            [['tour_id', 'day_number'], 'integer'],
            [['tour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tour::className(), 'targetAttribute' => ['tour_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tour_id' => 'Тур',
            'day_number' => 'Номер дня',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tour_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimetableItems()
    {
        return $this->hasMany(TimetableItem::className(), ['timetable_day_id' => 'id']);
    }
}
