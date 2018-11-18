<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property int $tour_id
 * @property string $user_name
 * @property string $phone
 * @property string $text
 * @property int $create_at
 * @property int $done_at
 * @property int $publish
 * @property int $from_widget
 * @property int $rank
 *
 * @property Tour $tour
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_id', 'create_at', 'done_at', 'publish', 'from_widget', 'rank'], 'integer'],
            [['user_name', 'phone', 'text'], 'required'],
            [['text'], 'string'],
            [['user_name', 'phone'], 'string', 'max' => 255],
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
            'tour_id' => 'Tour ID',
            'user_name' => 'User Name',
            'phone' => 'Phone',
            'text' => 'Text',
            'create_at' => 'Create At',
            'done_at' => 'Done At',
            'publish' => 'Publish',
            'from_widget' => 'From Widget',
            'rank' => 'Rank',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tour_id']);
    }
}
