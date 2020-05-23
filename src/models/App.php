<?php

namespace portalium\device\models;

use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;

class App extends ActiveRecord
{

    public static function tableName()
    {
        return 'app';
    }

    public function rules()
    {
        return [
            [['id', 'name', 'config'], 'required'],
            [['id'], 'integer'],
            [['config'], 'string'],
            [['name'], 'string', 'max' => 20],
            [['id'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'name' => Module::t('Name'),
            'config' => Module::t('Config'),
        ];
    }

    public function getProjectAppRelations()
    {
        return $this->hasMany(ProjectAppRelation::className(), ['app_id' => 'id']);
    }

    public static function find()
    {
        return new AppQuery(get_called_class());
    }
}
