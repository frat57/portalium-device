<?php

namespace portalium\device\models;

use yii\db\ActiveRecord;

class Device extends ActiveRecord
{
    public static function tableName()
    {
        return '{{device}}';
    }
    public function rules()
    {
        return [
            [['name', 'api'], 'required'],
            [['description'], 'string'],
            [['type'], 'integer'],
            [['name', 'api', 'properties', 'variable'], 'string', 'max' => 64],
            [['tag'], 'string', 'max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'api' => 'Api',
            'type'=> 'Type',
            'properties' => 'Properties',
            'variable' => 'Variable',
            'tag' => 'Tag'
        ];
    }
}
