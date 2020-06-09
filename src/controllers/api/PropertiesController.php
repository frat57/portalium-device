<?php

namespace portalium\device\controllers\api;

use Yii;
use portalium\device\models\Properties;
use portalium\rest\ActiveController as RestActiveController;
use yii\data\ActiveDataProvider;

class PropertiesController extends RestActiveController
{
    public $modelClass = 'portalium\device\models\Properties';

    public function actions(){
        $actions = parent::actions();
        unset($actions['index'],$actions['create'],$actions['delete'],$actions['view']);

        return $actions;
    }
    public function actionIndex($device_id){

        if(Properties::IsOwner($device_id) == true)
        {
            $activeData = new ActiveDataProvider([
                'query' => Properties::find()->where('device_id = '.$device_id)
            ]);
            return $activeData;
        }
        return null;
    }
    public function actionView($id){

        if(Properties::IsOwner($id) == true) {
            $activeData = new ActiveDataProvider([
                'query' => Properties::find()->where('id = ' .$id)
            ]);
            return $activeData;
        }
        return null;
    }
}
