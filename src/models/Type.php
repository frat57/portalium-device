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
            [['name', 'api', 'description', 'properties_id', 'variable_id', 'device_id'], 'required'],
            [['api', 'properties_id', 'variable_id', 'device_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 20],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
            [['variable_id'], 'exist', 'skipOnError' => true, 'targetClass' => Variable::className(), 'targetAttribute' => ['variable_id' => 'id']],
            [['properties_id'], 'exist', 'skipOnError' => true, 'targetClass' => Properties::className(), 'targetAttribute' => ['properties_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => Module::t('Name'),
            'api' => Module::t('Api'),
            'description' => Module::t('Description'),
            'properties_id' => Module::t('Properties ID'),
            'variable_id' => Module::t('Variable ID'),
            'device_id' => Module::t('Device ID'),
        ];
    }

    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }

    public function getProperties()
    {
        return $this->hasOne(Properties::className(), ['id' => 'properties_id']);
    }

    public function getVariable()
    {
        return $this->hasOne(Variable::className(), ['id' => 'variable_id']);
    }

    public static function find()
    {
        return new TypeQuery(get_called_class());
    }
}
