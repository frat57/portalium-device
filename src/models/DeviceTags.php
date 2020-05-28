<?php

namespace portalium\device\models;

use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;

class DeviceTags extends ActiveRecord
{

    public static function tableName()
    {
        return 'device_tags';
    }

    public function rules()
    {
        return [
            [['device_id', 'tag_id'], 'integer'],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'device_id' => Module::t('Device ID'),
            'tag_id' => Module::t('Tag ID'),
        ];
    }
    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }

    public function getTags()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    public static function find()
    {
        return new DeviceTagsQuery(get_called_class());
    }
}
