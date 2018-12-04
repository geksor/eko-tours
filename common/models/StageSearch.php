<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Stage;

/**
 * StageSearch represents the model behind the search form of `common\models\Stage`.
 */
class StageSearch extends Stage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'month_id', 'start_date', 'end_date', 'places', 'price', 'publish', 'deleted'], 'integer'],
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
        $query = Stage::find();

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
            'month_id' => $this->month_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'places' => $this->places,
            'price' => $this->price,
            'publish' => $this->publish,
            'deleted' => 0,
        ]);

        return $dataProvider;
    }
}
