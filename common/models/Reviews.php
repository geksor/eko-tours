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
 * @property int $viewed
 * @property int $agree
 * @property string $lastName
 *
 * @property Tour $tour
 */
class Reviews extends \yii\db\ActiveRecord
{
    public $lastName; /* Trap for bots */
    public $agree = 1;

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
            [['tour_id', 'publish', 'from_widget', 'rank', 'viewed'], 'integer'],
            [['user_name', 'phone', 'text'], 'required'],
            [['text'], 'string'],
            [['create_at', 'done_at',], 'safe'],
            [['user_name', 'phone', 'lastName'], 'string', 'max' => 255],
            [['tour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tour::className(), 'targetAttribute' => ['tour_id' => 'id']],
            [['rank'], 'default', 'value' => 100],
            ['agree', 'compare', 'compareValue' => 1, 'message' => 'Для того чтобы оставить отзыв необходимо согласиться с обработкой персональных данных.'],
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
            'user_name' => 'Имя',
            'phone' => 'Телефон',
            'text' => 'Текст отзыва',
            'create_at' => 'Создан',
            'done_at' => 'Изменен',
            'publish' => 'Публикация',
            'from_widget' => 'Выводить на главной',
            'rank' => 'Порядок вывода',
            'viewed' => 'Viewed',
            'agree' => 'Согласие на обработку данных',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tour_id']);
    }

    public function sendEmail()
    {
        $body = '<h1>Новый отзыв</h1>
                <p>
                    <a href="'. Yii::$app->request->hostInfo .'/admin/reviews/view/'. $this->id .'">Ссылка на отзыв</a>
                </p>
                <h2>Информация</h2>
                <p> ФИО: '.$this->user_name.'</p>
                <p> Текст отзыва: <br>'.$this->text . '</p>';

        return Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['Contact']['email'])
            ->setFrom(['info@eko-tour.ru' => 'Эко-Тур'])
            ->setSubject('Отзыв от: '. $this->user_name)
            ->setHtmlBody($body)
            ->send();
    }

    public function beforeSave($insert)
    {
        if ($this->create_at){

            $this->create_at =
                is_string($this->create_at)
                    ? strtotime($this->create_at)
                    : $this->create_at;
        }else{
            $this->create_at = time();
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
