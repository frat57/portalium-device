<?php

namespace portalium\device\models;

use portalium\helpers\ObjectHelper;
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
            [['name','user_id'], 'required'],
            [['id'], 'integer'],
            [['app_config', 'conn_type'], 'string'],
            [['name'], 'string', 'max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'name' => Module::t('Name'),
            'conn_type' => Module::t('Conn Type'),
            'app_config' => Module::t('App Config'),
        ];
    }

    public function getDevices()
    {
        return $this->hasMany(Device::className(), ['device_id' => 'id']);
    }
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }

}
