<?php

namespace portalium\device\models;

use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;
use portalium\helpers\ObjectHelper;

class Properties extends ActiveRecord
{
    const type_text = 0;
    const type_number = 1;
    const type_true = 2;
    const type_false = 3;
    const type_date = 4;

    public static function tableName()
    {
        return 'properties';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['key', 'description', 'value'], 'string'],
            [['device_id', 'type_id'], 'integer'],
            ['format', 'default', 'value'=> self::type_text],
            ['format', 'in' ,'range'=> self::getTypes()],
            [['name'], 'string', 'max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'name' => Module::t('Name'),
            'key' => Module::t('Key'),
            'description' => Module::t('Description'),
            'format' => Module::t('Format'),
            'value' => Module::t('Value'),
            'device_id' => Module::t('Device ID'),
            'type_id' => Module::t('Type ID'),
        ];
    }
    public static function IsOwner($id)
    {
        $user_id = Yii::$app->user->getId();

        $rows = (new \yii\db\Query())
            ->select(['p.id','p.device_id'])
            ->from('properties p')
            ->innerJoin("device d",
                'p.device_id = d.id')
            ->innerJoin('project pr',
                'd.project_id = pr.id')
            ->where('pr.user_id = ' .$user_id )
            ->where('p.id = ' .$id)
            ->all();

        if(count($rows) == 1) {
            return true;
        }
        return false;
    }
    public static function IsOwnerDevice($id)
    {
        $user_id = Yii::$app->user->getId();

        $rows = (new \yii\db\Query())
            ->select(['p.id','p.device_id'])
            ->from('properties p')
            ->innerJoin("device d",
                'p.device_id = d.id')
            ->innerJoin('project pr',
                'd.project_id = pr.id')
            ->where('pr.user_id = ' .$user_id )
            ->where('p.device_id = ' .$id)
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
        return new PropertiesQuery(get_called_class());
    }
    public static function getTypes()
    {
        return ObjectHelper::getConstants('type_',__CLASS__);
    }
}
