<?php

namespace portalium\device\controllers\api;

use portalium\device\models\Variable;
use portalium\site\Module;
use portalium\rest\ActiveController as RestActiveController;
use yii\data\ActiveDataProvider;

class VariablesController extends RestActiveController
{
    public $modelClass = 'portalium\device\models\Variable';

    public function actions(){
        $actions = parent::actions();
        unset($actions['index'],$actions['create'],$actions['update'],$actions['delete']);

        return $actions;
    }
    public function actionIndex(){
        $activeData = new ActiveDataProvider([
            'query' => Variable::find()->select('device_id')
        ]);
        return $activeData;
    }

}