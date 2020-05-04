<?php

namespace portalium\device\models;

use portalium\helpers\ObjectHelper;
use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;


class Properties extends ActiveRecord
{
    const type_false = 0;
    const type_true = 1;
    const type_date = 2;
    const type_number = 3;
    const text = 4;

    public static function tableName()
    {
        return '{{%properties}}';
    }

    public function rules()
    {
        return [
            [['name', 'key', 'description', 'format', 'device_id'], 'required'],
            [['key', 'description'], 'string'],
            ['format', 'default', 'value' => self::TYPE_INPUT],
            ['format','in','range' => self::getTypes()],
            [['name'], 'string', 'max' => 20],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
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
        ];
    }

    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }

    public function getTypes()
    {
        return $this->hasMany(Type::className(), ['properties_id' => 'id']);
    }

    public static function find()
    {
        return new PropertiesQuery(get_called_class());
    }
    public static function getType()
    {
        return ObjectHelper::getConstants('type_',__CLASS__);
    }
}
