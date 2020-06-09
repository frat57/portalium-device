<?php

namespace portalium\device\models;

use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;

class AppProject extends ActiveRecord
{

    public static function tableName()
    {
        return 'app_projects';
    }

    public function rules()
    {
        return [
            [['project_id', 'app_id','user_id'], 'required'],
            [['project_id', 'app_id','user_id'], 'integer'],
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
    public function IsOwner($id)
    {
        $user_id = Yii::$app->user->getId();

        $rows = (new \yii\db\Query())
            ->select(['a.id','a.user_id'])
            ->from('app a')
            ->innerJoin("app_projects ap",
                'a.id = ap.app_id')
            ->innerJoin('project p',
                'ap.project_id = p.id')
            ->where('ap.user_id = ' .$user_id )
            ->where('a.id = ' .$id )
            ->all();

        if(count($rows) >= 1) {
            return true;
        }
        return false;
    }
    public function IsOwnerUser($id)
    {
        $user_id = Yii::$app->user->getId();

        $rows = (new \yii\db\Query())
            ->select(['a.id','a.user_id'])
            ->from('app a')
            ->innerJoin("app_projects ap",
                'a.id = ap.app_id')
            ->innerJoin('project p',
                'ap.project_id = p.id')
            ->where('ap.user_id = ' .$id )
            ->all();

        if(count($rows) >= 1) {
            return true;
        }
        return false;
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
        return new AppProjectsQuery(get_called_class());
    }
}
