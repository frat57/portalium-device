<?php

namespace portalium\device\models;

use portalium\helpers\ObjectHelper;
use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;

class Data extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%data}}';
    }

    public function rules()
    {
        return [
            [['value'], 'required'],
            [['value'], 'string'],
            [['created_at'], 'safe'],
            [['variable_id'], 'exist', 'skipOnError' => true, 'targetClass' => Variable::className(), 'targetAttribute' => ['variable_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'value' => Module::t('Value'),
            'created_at' => Module::t('Created At'),
        ];
    }

    public function IsOwner($id)
    {
        $user_id = Yii::$app->user->getId();

        $rows = (new \yii\db\Query())
            ->select(['d.variable_id','d.value'])
            ->from('data d')
            ->innerJoin("variable v",
                'd.variable_id = v.id')
            ->innerJoin('device de',
                'v.device_id = de.id')
            ->innerJoin('project p',
                'de.project_id = p.id')
            ->where('p.user_id = ' .$user_id )
            ->where('v.id = ' .$id )
            ->all();

        if(count($rows) >= 1) {
            return true;
        }
        return false;
    }
    public function IsOwnerVariable($id)
    {
        $user_id = Yii::$app->user->getId();

        $rows = (new \yii\db\Query())
            ->select(['v.id'])
            ->from('variable v')
            ->innerJoin('device d',
                'v.device_id = d.id')
            ->innerJoin('project p',
                'd.project_id = p.id')
            ->where('p.user_id = ' .$user_id )
            ->all();

        if(count($rows) >= 1) {
            return true;
        }
        return false;
    }

    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }

    public static function find()
    {
        return new DataQuery(get_called_class());
    }

}
