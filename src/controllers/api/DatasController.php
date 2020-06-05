<?php

namespace portalium\device\controllers\api;

use portalium\device\models\Data;
use portalium\rest\ActiveController as RestActiveController;
use yii\data\ActiveDataProvider;

class DatasController extends RestActiveController
{
    public $modelClass = 'portalium\device\models\Data';

    public function actions(){
        $actions = parent::actions();
        unset($actions['index'],$actions['create'],$actions['update'],$actions['delete']);

        return $actions;
    }
    public function actionIndex(){
        $activeData = new ActiveDataProvider([
            'query' => Data::find()->select('variable_id')
        ]);
        return $activeData;
    }

}
