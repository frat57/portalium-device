<?php

namespace portalium\device\models;

use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;

class Type extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%type}}';
    }

    public function rules()
    {
        return [
            [['name', 'api'], 'required'],
            [['description'], 'string'],
            [['name','api'], 'string', 'max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'name' => Module::t('Name'),
            'api' => Module::t('Api'),
            'description' => Module::t('Description'),
        ];
    }

    public function getProperties()
    {
        return $this->hasMany(Properties::className(), ['type_id' => 'id']);
    }

    public function getVariables()
    {
        return $this->hasMany(Variable::className(), ['type_id' => 'id']);
    }

    public static function find()
    {
        return new TypeQuery(get_called_class());
    }
}
