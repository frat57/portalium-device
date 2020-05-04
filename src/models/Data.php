<?php

namespace portalium\device\models;
use yii\db\ActiveRecord;
use Yii;
use portalium\device\Module;

class Data extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%data}}';
    }

    public function rules()
    {
        return [
            [['device_id', 'data'], 'required'],
            [['device_id', 'data'], 'integer'],
            [['created_at'], 'safe'],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'device_id' => Module::t('Device ID'),
            'data' => Module::t('Data'),
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
}
