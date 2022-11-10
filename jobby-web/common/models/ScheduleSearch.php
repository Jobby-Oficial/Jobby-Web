<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Schedule;

/**
 * ScheduleSearch represents the model behind the search form of `common\models\Schedule`.
 */
class ScheduleSearch extends Schedule
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'payment', 'schedule_status', 'job_status_id', 'service_id', 'professional_id', 'client_id', 'created_at', 'updated_at'], 'integer'],
            [['service_date', 'service_time', 'note', 'schedule_status_note'], 'safe'],
            [['price'], 'number'],
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
        $query = Schedule::find();

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
            'service_date' => $this->service_date,
            'service_time' => $this->service_time,
            'payment' => $this->payment,
            'schedule_status' => $this->schedule_status,
            'price' => $this->price,
            'job_status_id' => $this->job_status_id,
            'service_id' => $this->service_id,
            'professional_id' => $this->professional_id,
            'client_id' => $this->client_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'schedule_status_note', $this->schedule_status_note]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchProfessional($params)
    {
        $query = Schedule::find()->where(['professional_id' => $params]);

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
            'service_date' => $this->service_date,
            'service_time' => $this->service_time,
            'payment' => $this->payment,
            'schedule_status' => $this->schedule_status,
            'price' => $this->price,
            'job_status_id' => $this->job_status_id,
            'service_id' => $this->service_id,
            'professional_id' => $this->professional_id,
            'client_id' => $this->client_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'schedule_status_note', $this->schedule_status_note]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchClient($params)
    {
        $query = Schedule::find()->where(['client_id' => $params]);

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
            'service_date' => $this->service_date,
            'service_time' => $this->service_time,
            'payment' => $this->payment,
            'schedule_status' => $this->schedule_status,
            'price' => $this->price,
            'job_status_id' => $this->job_status_id,
            'service_id' => $this->service_id,
            'professional_id' => $this->professional_id,
            'client_id' => $this->client_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'schedule_status_note', $this->schedule_status_note]);

        return $dataProvider;
    }
}
