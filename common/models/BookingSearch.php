<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Booking;

/**
 * BookingSearch represents the model behind the search form of `common\models\Booking`.
 */
class BookingSearch extends Booking
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tour_id', 'month_id', 'stage_id', 'places_count_beads', 'places_count_lavender', 'user_places_count', 'total_price', 'confirm', 'created_at', 'done_at', 'viewed'], 'integer'],
            [['customer_name', 'customer_phone'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Booking::find()->orderBy(['viewed' => SORT_ASC, 'created_at' => SORT_ASC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tour_id' => $this->tour_id,
            'month_id' => $this->month_id,
            'stage_id' => $this->stage_id,
            'places_count_beads' => $this->places_count_beads,
            'places_count_lavender' => $this->places_count_lavender,
            'user_places_count' => $this->user_places_count,
            'total_price' => $this->total_price,
            'confirm' => $this->confirm,
            'created_at' => $this->created_at,
            'done_at' => $this->done_at,
            'viewed' => $this->viewed,
        ]);

        $query->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'customer_phone', $this->customer_phone]);

        return $dataProvider;
    }
}
