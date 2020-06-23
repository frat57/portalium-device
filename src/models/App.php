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
            [['name','user_id'], 'required'],
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

    public static function IsOwner()
    {
        $user_id = Yii::$app->user->getId();

        $rows = (new \yii\db\Query())
            ->select(['a.id','a.user_id'])
            ->from('app a')
            ->innerJoin("app_projects ap",
                'a.id = ap.app_id')
            ->innerJoin('project p',
                'ap.project_id = p.id')
            ->where('a.user_id = ' .$user_id )
            ->all();

        if(count($rows) >= 1) {
            return true;
        }
        return false;
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
