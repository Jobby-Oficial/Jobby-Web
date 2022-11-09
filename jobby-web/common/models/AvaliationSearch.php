<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Avaliation;

/**
 * AvaliationSearch represents the model behind the search form of `common\models\Avaliation`.
 */
class AvaliationSearch extends Avaliation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            /*[['id', 'service_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['avaliation'], 'number'],*/

            [['id', 'avaliation', 'service_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
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
        $query = Avaliation::find();

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
            'avaliation' => $this->avaliation,
            'service_id' => $this->service_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
