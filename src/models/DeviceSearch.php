<?php

namespace portalium\device\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use portalium\device\models\Device;

class DeviceSearch extends Device
{
    public function rules()
    {
        return [
            [['id', 'type'], 'integer'],
            [['name', 'api', 'description', 'properties', 'variable', 'tag'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Device::find();

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
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'api', $this->api])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'properties', $this->properties])
            ->andFilterWhere(['like', 'variable', $this->variable])
            ->andFilterWhere(['like', 'tag', $this->tag]);

        return $dataProvider;
    }
}
