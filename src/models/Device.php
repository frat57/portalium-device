<?php

namespace portalium\device\models;

use yii\db\ActiveRecord;
use portalium\device\Module;
use portalium\helpers\ObjectHelper;

class Device extends ActiveRecord
{
    const type_false = 0;
    const type_true = 1;
    const type_date = 2;
    const type_number = 3;
    const text = 4;
    public static function tableName()
    {
        return '{{device}}';
    }
    public function rules()
    {
        return [
            [['name', 'api'], 'required'],
            [['description'], 'string'],
            ['type', 'default', 'value' => self::TYPE_INPUT],
            ['type','in','range' => self::getTypes()],
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
    public static function getTypes()
    {
        return ObjectHelper::getConstants('TYPE_',__CLASS__);
    }

}
