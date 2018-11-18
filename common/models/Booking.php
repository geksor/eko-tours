<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property int $tour_id
 * @property int $month_id
 * @property int $stage_id
 * @property int $places_count_beads
 * @property int $places_count_lavender
 * @property int $user_places_count
 * @property int $total_price
 * @property string $customer_name
 * @property string $customer_phone
 *
 * @property Month $month
 * @property Stage $stage
 * @property Tour $tour
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_id', 'month_id', 'stage_id', 'places_count_beads', 'places_count_lavender', 'user_places_count', 'total_price'], 'integer'],
            [['customer_name', 'customer_phone'], 'required'],
            [['customer_name', 'customer_phone'], 'string', 'max' => 255],
            [['month_id'], 'exist', 'skipOnError' => true, 'targetClass' => Month::className(), 'targetAttribute' => ['month_id' => 'id']],
            [['stage_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stage::className(), 'targetAttribute' => ['stage_id' => 'id']],
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
            'month_id' => 'Month ID',
            'stage_id' => 'Stage ID',
            'places_count_beads' => 'Places Count Beads',
            'places_count_lavender' => 'Places Count Lavender',
            'user_places_count' => 'User Places Count',
            'total_price' => 'Total Price',
            'customer_name' => 'Customer Name',
            'customer_phone' => 'Customer Phone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMonth()
    {
        return $this->hasOne(Month::className(), ['id' => 'month_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStage()
    {
        return $this->hasOne(Stage::className(), ['id' => 'stage_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tour_id']);
    }
}
