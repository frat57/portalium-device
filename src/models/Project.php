<?php

namespace portalium\device\models;

use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;

class Project extends ActiveRecord
{

    public static function tableName()
    {
        return 'project';
    }

    public function rules()
    {
        return [
            [['id', 'projectName', 'device_id', 'connType'], 'required'],
            [['id', 'projectName', 'device_id', 'connType'], 'integer'],
            [['id'], 'unique'],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'projectName' => Module::t('Project Name'),
            'device_id' => Module::t('Device ID'),
            'connType' => Module::t('Conn Type'),
        ];
    }

    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }

    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }
}
