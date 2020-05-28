<?php

namespace portalium\device\models;

use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;
use dosamigos\taggable\Taggable;

class Tag extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%tag}}';
    }
    public function behaviors()
    {
        return [
            // for different configurations, please see the code
            // we have created tables and relationship in order to
            // use defaults settings
            Taggable::className(),
        ];
    }

    public function rules()
    {
        return [
            [['device_id', 'id'], 'integer'],
            [['name','frequency'], 'string', 'max' => 20],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'device_id' => Module::t('Device ID'),
            'name' => Module::t('Tags'),
            'id' => Module::t('ID'),
            'frequency' => Module::t('Sıklık'),
        ];
    }

    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }

    public static function find()
    {
        return new TagQuery(get_called_class());
    }
}
