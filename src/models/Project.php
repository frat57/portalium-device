<?php

namespace portalium\device\models;

use portalium\helpers\ObjectHelper;
use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;

class Project extends ActiveRecord
{

    public static function tableName()
    {
        return 'project';
    }

    public function rules()
    {
        return [
            [['name','user_id'], 'required'],
            [['id'], 'integer'],
            [['app_config'], 'string'],
            [['name'], 'string', 'max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'name' => Module::t('Name'),
            'app_config' => Module::t('App Config'),
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
            ->where('p.user_id = ' .$user_id )
            ->where('p.id = ' .$id )
            ->all();

        if(count($rows) == 1) {
            return true;
        }
        return false;
    }
    public function getApp()
    {
        return $this->hasMany(App::className(), ['id' => 'app_id']);
    }

    public function getDevices()
    {
        return $this->hasMany(Device::className(), ['device_id' => 'id']);
    }
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }

}
