<?php

namespace portalium\device\models;

use Yii;
use yii\db\ActiveRecord;
use portalium\device\Module;

class TblTourTagAssn extends ActiveRecord
{

    public static function tableName()
    {
        return 'tbl_tour_tag_assn';
    }

    public function rules()
    {
        return [
            [['device_id', 'tag_id'], 'integer'],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'device_id' => Module::t('Tour ID'),
            'tag_id' => Module::t('Tag ID'),
        ];
    }

    public static function find()
    {
        return new TblTourTagAssnQuery(get_called_class());
    }
}
