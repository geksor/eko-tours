<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stage".
 *
 * @property int $id
 * @property int $month_id
 * @property int $start_date
 * @property int $end_date
 * @property int $price
 * @property int $publish
 * @property int $deleted
 * @property int $places
 *
 * @property Booking[] $bookings
 * @property StagePrice[] $stagePrices
 * @property Month $month
 */
class Stage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['month_id', 'price'], 'required'],
            [['start_date', 'end_date',], 'safe'],
            [['month_id', 'places', 'price', 'publish', 'deleted'], 'integer'],
            [['month_id'], 'exist', 'skipOnError' => true, 'targetClass' => Month::className(), 'targetAttribute' => ['month_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'month_id' => 'Месяц',
            'start_date' => 'Начало заезда',
            'end_date' => 'Завершение заезда',
            'places' => 'Кол-во мест',
            'price' => 'Цена',
            'publish' => 'Публикация',
            'deleted' => 'Удален',
        ];
    }

    /**
     * @param array $monthIds
     * @return array|Accom[]|Stage[]|\yii\db\ActiveRecord[]
     */
    public static function getModelsByMonthIds($monthIds)
    {
        $models = self::find()
            ->where(['month_id' => $monthIds, 'publish' => 1, 'deleted' => 0])
            ->andWhere(['>', 'start_date', strtotime('today')-100])
            ->with(['stagePrices' => function (\yii\db\ActiveQuery $query) {
                $query->forPricePage();
            }])
            ->orderBy(['start_date' => SORT_ASC])
            ->all();
        $result['models'] = $models;

        foreach ($models as $model){
            $stagePrices = [];
            $stagePricesAccoms = [];

            foreach ($model->stagePrices as $stagePrice){
                $stagePrices[$stagePrice->accom_id][] = $stagePrice;
                if (!isset($stagePricesAccoms[$stagePrice->accom_id])){
                    $stagePricesAccoms[$stagePrice->accom_id] = $stagePrice->accom;
                }
            }

            $result['prices'][$model->id] = $stagePrices;
            $result['accoms'][$model->id] = $stagePricesAccoms;
        }

        return $result;
    }

    public static function getStartDate($month_id)
    {
        return Yii::$app->formatter->asDate(Month::findOne(['id' => $month_id])->title, 'php:d.m.Y H:i');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['stage_id' => 'id']);
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
    public function getStagePrices()
    {
        return $this->hasMany(StagePrice::className(), ['stage_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if ($this->start_date){

            $this->start_date =
                is_string($this->start_date)
                    ? strtotime($this->start_date)
                    : $this->start_date;
        }
        if ($this->end_date){

            $this->end_date =
                is_string($this->end_date)
                    ? strtotime($this->end_date)
                    : $this->end_date;
        }
        return parent::beforeSave($insert);
    }
}
