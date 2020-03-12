<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property int $tour_id
 * @property int $month_id
 * @property int $stage_id
 * @property int $user_places_count
 * @property int $total_price
 * @property string $customer_name
 * @property string $customer_phone
 * @property int $confirm
 * @property int $created_at
 * @property int $done_at
 * @property int $viewed
 * @property int $agree
 * @property string $lastName
 * @property int $tour_period_room_id
 * @property int $room_id
 * @property int $period_id
 *
 * @property Month $month
 * @property TourPeriodRooms $tourPeriodRoom
 * @property Stage $stage
 * @property Tour $tour
 * @property Room $room
 * @property TourPeriod $period
 */
class Booking extends \yii\db\ActiveRecord
{
    public $lastName; /* Trap for bots */
    public $agree = 1;
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
            [['tour_id', 'month_id', 'stage_id', 'tour_period_room_id', 'room_id', 'period_id', 'user_places_count', 'total_price', 'confirm', 'created_at', 'done_at', 'viewed'], 'integer'],
            [['customer_name', 'customer_phone'], 'required'],
            [['customer_name', 'customer_phone', 'lastName'], 'string', 'max' => 255],
            ['agree', 'compare', 'compareValue' => 1, 'message' => 'Для бронирования тура необходимо согласиться с обработкой персональных данных.'],
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
            'month_id' => 'Месяц',
            'stage_id' => 'Заезд',
            'tour_period_room_id' => 'Заезд в номера',
            'room_id' => 'Номер',
            'period_id' => 'Период',
            'user_places_count' => 'Кол-во мест',
            'total_price' => 'Стоимость',
            'customer_name' => 'Имя Клиента',
            'customer_phone' => 'Телефон клиента',
            'confirm' => 'Подтверждение',
            'created_at' => 'Дата создания',
            'done_at' => 'Дата изменения',
            'viewed' => 'Viewed',
            'agree' => 'Согласие на обработку данных',
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
    public function getTourPeriodRoom()
    {
        return $this->hasOne(TourPeriodRooms::className(), ['id' => 'tour_period_room_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriod()
    {
        return $this->hasOne(TourPeriod::className(), ['id' => 'period_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tour_id']);
    }

    public static function getTourFromFilter ()
    {
        $modelsArr = Tour::find()->select(['id', 'title'])->asArray()->all();

        return ArrayHelper::map($modelsArr, 'id', 'title');

    }

    public static function getMonthFromFilter ()
    {
        $modelsArr = Month::find()->select(['id', 'title'])->asArray()->all();

        foreach ($modelsArr as $key => $month){
            $modelsArr[$key]['title'] = Yii::$app->formatter->asDate($month['title'], 'php:M');
        }

        return ArrayHelper::map($modelsArr, 'id', 'title');

    }

    public static function getStageFromFilter ()
    {
        $modelsArr = Stage::find()->select(['id', 'start_date'])->asArray()->all();

        foreach ($modelsArr as $key => $month){
            $modelsArr[$key]['start_date'] = Yii::$app->formatter->asDate($month['start_date']);
        }


        return ArrayHelper::map($modelsArr, 'id', 'start_date');

    }


    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     * @throws \yii\base\InvalidConfigException
     */
    public function sendEmail()
    {
        $body = '<h1>Бронь тура с сайта</h1>
                <p>
                    <a href="'. Yii::$app->request->hostInfo .'/admin/booking/view/'. $this->id .'">Ссылка на бронь</a>
                </p>
                <h2>Информация</h2>
                <p> Дата бронирования: '.Yii::$app->formatter->asDate($this->created_at, 'long').'</p>
                <p> Время бронирования: '.Yii::$app->formatter->asTime($this->created_at).'</p>
                <p> Имя: '.$this->customer_name.'</p>
                <p> Телефон: '.$this->customer_phone . '</p>';

        return Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['Contact']['email'])
            ->setFrom(['info@eko-tours.com' => 'EcoTour'])
            ->setSubject('Бронь тура: '. $this->tour->title)
            ->setHtmlBody($body)
            ->send();
    }


    public function beforeSave($insert)
    {
        if ($this->created_at){

            $this->created_at =
                is_string($this->created_at)
                    ? strtotime($this->created_at)
                    : $this->created_at;
        }else{
            $this->created_at = time();
        }
        return parent::beforeSave($insert);
    }
}
