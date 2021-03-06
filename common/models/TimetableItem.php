<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "timetable_item".
 *
 * @property int $id
 * @property int $timetable_day_id
 * @property int $start_time
 * @property int $end_time
 * @property string $text
 * @property int $publish
 *
 * @property TimetableDay $timetableDay
 */
class TimetableItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'timetable_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['timetable_day_id', 'start_time'], 'required'],
            [['timetable_day_id', 'publish'], 'integer'],
            [['text'], 'string'],
            [['start_time', 'end_time',], 'safe'],
            [['timetable_day_id'], 'exist', 'skipOnError' => true, 'targetClass' => TimetableDay::className(), 'targetAttribute' => ['timetable_day_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'timetable_day_id' => 'День',
            'start_time' => 'Время начала',
            'end_time' => 'Время завершения',
            'text' => 'Текст',
            'publish' => 'Публикация',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimetableDay()
    {
        return $this->hasOne(TimetableDay::className(), ['id' => 'timetable_day_id']);
    }

    public function beforeSave($insert)
    {
        if ($this->start_time){

            $this->start_time =
                is_string($this->start_time)
                    ? strtotime($this->start_time)
                    : $this->start_time;
        }
        if ($this->end_time){

            $this->end_time =
                is_string($this->end_time)
                    ? strtotime($this->end_time)
                    : $this->end_time;
        }
        return parent::beforeSave($insert);
    }
}
