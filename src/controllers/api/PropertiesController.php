<?php

namespace portalium\device\controllers\api;

use portalium\device\models\Properties;
use portalium\rest\ActiveController as RestActiveController;
use yii\data\ActiveDataProvider;

class PropertiesController extends RestActiveController
{
    public $modelClass = 'portalium\device\models\Properties';

    public function actions(){
        $actions = parent::actions();
        unset($actions['index'],$actions['create'],$actions['update'],$actions['delete']);

        return $actions;
    }
    public function actionIndex(){
        $activeData = new ActiveDataProvider([
            'query' => Properties::find()->select(['id','device_id'])
        ]);
        return $activeData;
    }
}
