<?php

namespace portalium\device\models;

use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;

class Variable extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%variable}}';
    }

    public function rules()
    {
        return [
            [['name', 'api', 'description', 'range', 'unit', 'device_id', 'type_id'], 'required'],
            [['description', 'unit'], 'string'],
            [['range', 'device_id', 'type_id'], 'integer'],
            [['name', 'api'], 'string', 'max' => 20],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'name' => Module::t('Name'),
            'api' => Module::t('Api'),
            'description' => Module::t('Description'),
            'range' => Module::t('Range'),
            'unit' => Module::t('Unit'),
            'device_id' => Module::t('Device ID'),
            'type_id' => Module::t('Type ID'),
        ];
    }

    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }

    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    public static function find()
    {
        return new VariableQuery(get_called_class());
    }
}
