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
            [['name'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'name' => Module::t('Name'),
        ];
    }

    public function getAppProjects()
    {
        return $this->hasMany(AppProjects::className(), ['app_id' => 'id']);
    }
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['id' => 'project_id'])->viaTable('app_projects', ['app_id' => 'id']);
    }

    public static function find()
    {
        return new AppQuery(get_called_class());
    }
}
