<?php

namespace portalium\device\models;

use Yii;
use portalium\device\Module;

class Tag extends \yii\db\ActiveRecord
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
        ];
    }

    public function attributeLabels()
    {
        return [
            'device_id' => Module::t('Device ID'),
            'name' => Module::t('Name'),
        ];
    }

    public static function find()
    {
        return new TagSearch(get_called_class());
    }
}
