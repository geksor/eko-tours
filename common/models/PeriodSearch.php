<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TourPeriod;

/**
 * TourPeriodSearch represents the model behind the search form of `common\models\TourPeriod`.
 */
class PeriodSearch extends TourPeriod
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tour_id'], 'integer'],
            [['start', 'end'], 'date']
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
        $query = TourPeriod::find()->orderBy(['id' => SORT_DESC]);

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
            'start' => $this->start,
            'end' => $this->end,
            'publish' => $this->publish,
        ]);

        return $dataProvider;
    }
}
