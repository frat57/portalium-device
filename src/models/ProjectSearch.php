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
            [['id', 'projectName', 'device_id', 'connType'], 'integer'],
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
            'projectName' => $this->projectName,
            'device_id' => $this->device_id,
            'connType' => $this->connType,
        ]);

        return $dataProvider;
    }
}