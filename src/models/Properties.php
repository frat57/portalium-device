<?php

namespace portalium\device\models;

use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;

class Properties extends \yii\db\ActiveRecord
{
    const type_text = 0;
    const type_number = 1;
    const type_true = 2;
    const type_false = 3;
    const type_date = 4;

    public static function tableName()
    {
        return 'properties';
    }

    public function rules()
    {
        return [
            [['name',  'format'], 'required'],
            [['key', 'description', 'value', 'type_key', 'type_description', 'type_value'], 'string'],
            [['device_id', 'type_id', 'type_format'], 'integer'],
            ['format', 'default', 'value'=> self::type_text],
            ['format', 'in' ,'range'=> self::getTypes()],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['name', 'type_name'], 'string', 'max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'name' => Module::t('Name'),
            'key' => Module::t('Key'),
            'description' => Module::t('Description'),
            'format' => Module::t('Format'),
            'value' => Module::t('Value'),
            'device_id' => Module::t('Device ID'),
            'type_id' => Module::t('Type ID'),
            'type_name' => Module::t('Type Name'),
            'type_key' => Module::t('Type Key'),
            'type_description' => Module::t('Type Description'),
            'type_format' => Module::t('Type Format'),
            'type_value' => Module::t('Type Value'),
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
        return new PropertiesQuery(get_called_class());
    }
    public static function getTypes()
    {
        return ObjectHelper::getConstants('type_',__CLASS__);
    }
}
