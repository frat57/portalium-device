<?php

namespace portalium\device\models;

use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;

class Tag extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%tag}}';
    }

    public function rules()
    {
        return [
            [['device_id', 'name'], 'required'],
            [['device_id'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'device_id' => Yii::t('app', 'Device ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }


    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }

    public static function find()
    {
        return new TagQuery(get_called_class());
    }
}
