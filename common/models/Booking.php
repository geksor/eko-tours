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
 *
 * @property Month $month
 * @property Stage $stage
 * @property Tour $tour
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
            [['tour_id', 'month_id', 'stage_id', 'user_places_count', 'total_price', 'confirm', 'created_at', 'done_at', 'viewed'], 'integer'],
            [['tour_id', 'month_id', 'stage_id', 'customer_name', 'customer_phone'], 'required'],
            [['customer_name', 'customer_phone', 'lastName'], 'string', 'max' => 255],
            [['month_id'], 'exist', 'skipOnError' => true, 'targetClass' => Month::className(), 'targetAttribute' => ['month_id' => 'id']],
            [['stage_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stage::className(), 'targetAttribute' => ['stage_id' => 'id']],
            [['tour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tour::className(), 'targetAttribute' => ['tour_id' => 'id']],
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
     */
    public function sendEmail()
    {
        $body = '<h1>Запрос обратного звонка</h1>
                <p>
                    <a href="'. Yii::$app->request->hostInfo .'/admin/call-back/view/'. $this->id .'">Ссылка на запрос</a>
                </p>
                <h2>Информация</h2>
                <p> Дата запроса: '.Yii::$app->formatter->asDate($this->created_at, 'long').'</p>
                <p> Время запроса: '.Yii::$app->formatter->asTime($this->created_at).'</p>
                <p> Имя: '.$this->name.'</p>
                <p> Телефон: '.$this->phone . '</p>';

        return Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['Contact']['email'])
            ->setFrom(['info@eco-tour.ru' => 'EcoTour'])
            ->setSubject('Запрос обратного звонка: '. $this->name)
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
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
