<?php

namespace portalium\device\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "{{%variable}}".
 *
 * @property int $id
 * @property string $name
 * @property string $api
 * @property string $description
 * @property int $range
 * @property string $unit
 * @property int $device_id
 *
 * @property Device $device
 * @property Type[] $types
 */
class Variable extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%variable}}';
    }

    public function rules()
    {
        return [
            [['name', 'api', 'description', 'range', 'unit', 'device_id'], 'required'],
            [['description', 'unit'], 'string'],
            [['range', 'device_id'], 'integer'],
            [['name', 'api'], 'string', 'max' => 20],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'name' => Module::t('Name'),
            'api' => Module::t('Api'),
            'description' => Module::t('Description'),
            'range' => Module::t('Range'),
            'unit' => Module::t('Unit'),
            'device_id' => Module::t('Device ID'),
        ];
    }

    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }

    public function getTypes()
    {
        return $this->hasMany(Type::className(), ['variable_id' => 'id']);
    }

    public static function find()
    {
        return new VariableQuery(get_called_class());
    }
}
