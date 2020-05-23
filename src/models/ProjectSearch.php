<?php

namespace portalium\device\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use portalium\device\models\Project;

class ProjectSearch extends Project
{

    public function rules()
    {
        return [
            [['id', 'conn_type'], 'integer'],
            [['name', 'device_name', 'app_config'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Project::find();

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
            'conn_type' => $this->conn_type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'device_name', $this->device_name])
            ->andFilterWhere(['like', 'app_config', $this->app_config]);

        return $dataProvider;
    }
}
