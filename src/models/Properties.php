<?php

namespace portalium\device\models;

use Yii;
use portalium\helpers\ObjectHelper;
use yii\db\ActiveRecord;
use portalium\device\Module;

class Properties extends ActiveRecord
{
    const type_false = 0;
    const type_true = 1;
    const type_date = 2;
    const type_number = 3;
    const type_text = 4;

    public static function tableName()
    {
        return '{{%properties}}';
    }

    public function rules()
    {
        return [
            [['name', 'key', 'description', 'format', 'device_id', 'type_id'], 'required'],
            [['key', 'description'], 'string'],
            [['format', 'device_id', 'type_id'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
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
        return new PropertiesQuery(get_called_class());
    }
    public static function getTypes()
    {
        return ObjectHelper::getConstants('type_',__CLASS__);
    }

}
