<?php

namespace portalium\device\models;

use yii\db\ActiveRecord;
use portalium\device\Module;

class Device extends ActiveRecord
{
    public static function tableName()
    {
        return '{{device}}';
    }
    public function rules()
    {
        return [
            [['name', 'api'], 'required'],
            [['description'], 'string'],
            [['type'], 'integer'],
            [['name', 'api', 'properties', 'variable'], 'string', 'max' => 64],
            [['tag'], 'string', 'max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'name' => Module::t('Name'),
            'api' => Module::t('Api'),
            'type'=> Module::t('Type'),
            'properties' => Module::t('Properties'),
            'variable' => Module::t('Vartiable'),
            'tag' => Module::t('Tag')
        ];
    }

}
