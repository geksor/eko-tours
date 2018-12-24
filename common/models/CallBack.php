<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "call_back".
 *
 * @property int $id
 * @property string $user_name
 * @property string $phone
 * @property int $is_consult
 * @property int $created_at
 * @property int $done_at
 * @property int $viewed
 * @property string $lastName
 */
class CallBack extends \yii\db\ActiveRecord
{
    public $lastName; /* Trap for bots */
    public $agree = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'call_back';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_name', 'phone'], 'required'],
            [['is_consult', 'created_at', 'done_at', 'viewed'], 'integer'],
            [['user_name', 'phone', 'lastName'], 'string', 'max' => 255],
            ['agree', 'compare', 'compareValue' => 1, 'message' => 'Для того чтобы отправить данные необходимо согласиться с обработкой персональных данных.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => 'Имя',
            'phone' => 'Телефон',
            'is_consult' => 'Тип',
            'created_at' => 'Дата создания',
            'done_at' => 'Дата изменения',
            'viewed' => 'Viewed',
        ];
    }


    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail()
    {
        $mailHead = $this->is_consult?'Запрос консультации':'Запрос обратного звонка';
        $body = '<h1>'.$mailHead.'</h1>
                <p>
                    <a href="'. Yii::$app->request->hostInfo .'/admin/call-back/view/'. $this->id .'">Ссылка на запрос</a>
                </p>
                <h2>Информация</h2>
                <p> Дата запроса: '.Yii::$app->formatter->asDate($this->created_at, 'long').'</p>
                <p> Время запроса: '.Yii::$app->formatter->asTime($this->created_at).'</p>
                <p> Имя: '.$this->user_name.'</p>
                <p> Телефон: '.$this->phone . '</p>';

        return Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['Contact']['email'])
            ->setFrom(['info@eko-tours.com' => 'EcoTour'])
            ->setSubject($mailHead.': '. $this->user_name)
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
