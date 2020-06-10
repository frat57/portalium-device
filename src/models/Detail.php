<?php

namespace portalium\device\models;

use portalium\helpers\ObjectHelper;
use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;

class Detail extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'detail';
    }

    public function rules()
    {
        return [
            [['widget_id', 'properties_id', 'variable_id', 'project_id'], 'required'],
            [['id', 'widget_id', 'properties_id', 'variable_id', 'project_id'], 'integer'],
            [['id'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'widget_id' => Module::t('Widget ID'),
            'properties_id' => Module::t('Properties ID'),
            'variable_id' => Module::t('Variable ID'),
            'project_id' => Module::t('Project ID'),
        ];
    }

    public function IsOwner($id)
    {
        $user_id = Yii::$app->user->getId();

        $rows = (new \yii\db\Query())
            ->select(['d.id'])
            ->from('detail d')
            ->innerJoin('project p',
                'd.project_id = p.id')
            ->where('p.user_id = ' .$user_id )
            ->where('p.id = ' .$id )
            ->all();

        if(count($rows) == 1) {
            return true;
        }
        return false;
    }

    public static function find()
    {
        return new DetailQuery(get_called_class());
    }
}
