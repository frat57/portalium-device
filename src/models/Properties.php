<?php

namespace portalium\device\models;

use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;
/**
 * This is the model class for table "{{%properties}}".
 *
 * @property int $id
 * @property string $name
 * @property string $key
 * @property string $description
 * @property int $format
 * @property int $device_id
 *
 * @property Device $device
 * @property Type[] $types
 */
class Properties extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%properties}}';
    }

    public function rules()
    {
        return [
            [['name', 'key', 'description', 'format', 'device_id'], 'required'],
            [['key', 'description'], 'string'],
            [['format', 'device_id'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
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
            'device_id' => Module::t('Device ID'),
        ];
    }

    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }

    public function getTypes()
    {
        return $this->hasMany(Type::className(), ['properties_id' => 'id']);
    }

    public static function find()
    {
        return new PropertiesQuery(get_called_class());
    }
}
