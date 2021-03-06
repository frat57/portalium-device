<?php

namespace portalium\device\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use portalium\device\models\Type;

class TypeSearch extends Type
{

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'api', 'description'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Type::find();


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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'api', $this->api])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
