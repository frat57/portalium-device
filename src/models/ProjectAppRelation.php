<?php

namespace portalium\device\models;

use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;

class ProjectAppRelation extends ActiveRecord
{

    public static function tableName()
    {
        return 'app_projects';
    }

    public function rules()
    {
        return [
            [['project_id', 'app_id'], 'required'],
            [['project_id', 'app_id'], 'integer'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['app_id'], 'exist', 'skipOnError' => true, 'targetClass' => App::className(), 'targetAttribute' => ['app_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'project_id' => Module::t('Project ID'),
            'app_id' => Module::t('App ID'),
        ];
    }

    public function getApp()
    {
        return $this->hasOne(App::className(), ['id' => 'app_id']);
    }

    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    public static function find()
    {
        return new ProjectAppRelationQuery(get_called_class());
    }
}
