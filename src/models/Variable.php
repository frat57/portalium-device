<?php

namespace portalium\device\models;

use portalium\helpers\ObjectHelper;
use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;

class Variable extends ActiveRecord
{
    const type_intfalse = 0;
    const type_inttrue = 1;

    public static function tableName()
    {
        return 'variable';
    }

    public function rules()
    {
        return [
            [['name', 'api'], 'required'],
            [['description', 'unit'], 'string'],
            [['range', 'device_id','type'], 'integer'],
            ['type', 'default', 'value'=> self::type_intfalse],
            ['type', 'in' ,'range'=> self::getTypes()],
            [['name', 'api'], 'string', 'max' => 20],
        ];
    }

    public static function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'name' => Module::t('Name'),
            'api' => Module::t('Api'),
            'description' => Module::t('Description'),
            'range' => Module::t('Range'),
            'unit' => Module::t('Unit'),
            'type' => Module::t('Type'),
            'device_id' => Module::t('Device ID'),
            'type_id' => Module::t('Type ID'),
        ];
    }
    public static function IsOwner($id)
    {
        $user_id = Yii::$app->user->getId();

        $rows = (new \yii\db\Query())
            ->select(['v.device_id'])
            ->from('variable v')
            ->innerJoin("device d",
                'v.device_id = d.id')
            ->innerJoin('project p',
                'd.project_id = p.id')
            ->where('p.user_id = ' .$user_id )
            ->where('v.device_id = ' .$id)
            ->all();

        if(count($rows) == 1) {
            return true;
        }
        return false;

    }
    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }

    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    public static function find()
    {
        return new VariableQuery(get_called_class());
    }
    public static function getTypes()
    {
        return ObjectHelper::getConstants('type_',__CLASS__);
    }
}
