<?php

namespace portalium\device\controllers\api;

use portalium\device\models\Device;
use portalium\rest\ActiveController as RestActiveController;
use yii\data\ActiveDataProvider;

class DevicesController extends RestActiveController
{
    public $modelClass = 'portalium\device\models\Device';
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'],$actions['create'],$actions['update'],$actions['delete'],$actions['view']);
        return $actions;
    }
    public function actionIndex(){

            $activeData = new ActiveDataProvider([
                'query' => Device::find()
            ]);
            return $activeData;
    }
    public function actionView($id){
        if(Device::IsOwner($id) == true) {
            $activeData = new ActiveDataProvider([
                'query' => Device::find()->where('id = ' .$id)
            ]);
            return $activeData;
        }
        return null;
    }
}
