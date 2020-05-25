<?php

namespace portalium\device\models;

use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;
use dosamigos\selectize\SelectizeTextInput;
use dosamigos\taggable\Taggable;

class Device extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%device}}';
    }
    public function behaviors()
    {
        return [
            // for different configurations, please see the code
            // we have created tables and relationship in order to
            // use defaults settings
            'class' => Taggable::className(),
        ];
    }

    public function rules()
    {
        return [
            [['name', 'api'], 'required'],
            [['tag_name'], 'safe'],
            [['description'], 'string'],
            [['type_id'], 'integer'],
            [['name', 'api'], 'string', 'max' => 64],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'name' => Module::t('Name'),
            'api' => Module::t('Api'),
            'description' => Module::t('Description'),
            'type' => Module::t('type'),
        ];
    }

    public function getDatas()
    {
        return $this->hasMany(Data::className(), ['device_id' => 'id']);
    }

    public function getProperties()
    {
        return $this->hasMany(Properties::className(), ['device_id' => 'id']);
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('tbl_tour_tag_assn', ['device_id' => 'id']);
    }

    public function getTypes()
    {
        return $this->hasMany(Type::className(), ['device_id' => 'id']);
    }
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['project_id' => 'id']);
    }

    public function getVariables()
    {
        return $this->hasMany(Variable::className(), ['device_id' => 'id']);
    }


    public static function find()
    {
        return new DeviceQuery(get_called_class());
    }
}
