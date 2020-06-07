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
            [
            'class' => Taggable::className(),
            ],
        ];
    }

    public function rules()
    {
        return [
            [['name', 'api'], 'required'],
            [['tagNames'], 'safe'],
            [['description'], 'string'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['project_id' => 'id']],
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
            'type' => Module::t('Type'),
            'tagNames' => Module::t('Tag'),
        ];
    }

    public function IsOwner($id)
    {
        $user_id = Yii::$app->user->getId();

        $rows = (new \yii\db\Query())
            ->select('d.id')
            ->from('device d')
            ->innerJoin("project p",
                'd.project_id = p.id')
            ->where('p.user_id = ' .$user_id )
            ->where('d.id = ' .$id )
            ->all();

        if(count($rows) == 1) {
            return true;
        }
        return false;
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
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('device_tags', ['device_id' => 'id']);
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
