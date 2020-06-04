<?php

namespace portalium\device\models;

use portalium\helpers\ObjectHelper;
use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;

class Data extends ActiveRecord
{
    const type_intfalse = 0;
    const type_inttrue = 1;

    public static function tableName()
    {
        return '{{%data}}';
    }

    public function rules()
    {
        return [
            [['device_id', 'value', 'type'], 'required'],
            [['device_id', 'type'], 'integer'],
            [['value'], 'string'],
            ['type', 'default', 'value'=> self::type_intfalse],
            ['type', 'in' ,'range'=> self::getTypes()],
            [['created_at'], 'safe'],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
            [['variable_id'], 'exist', 'skipOnError' => true, 'targetClass' => Variable::className(), 'targetAttribute' => ['variable_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'device_id' => Module::t('Device ID'),
            'value' => Module::t('Value'),
            'type' => Module::t('Type'),
            'created_at' => Module::t('Created At'),
        ];
    }

    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }

    public static function find()
    {
        return new DataQuery(get_called_class());
    }
    public static function getType()
    {
        return ObjectHelper::getConstants('type_',__CLASS__);
    }
}
