<?php

namespace portalium\device\controllers\api;

use Yii;
use portalium\device\models\Variable;
use portalium\rest\ActiveController as RestActiveController;
use yii\data\ActiveDataProvider;
use yii\web\UnauthorizedHttpException;

class VariablesController extends RestActiveController
{
    public $modelClass = 'portalium\device\models\Variable';

    public function actions(){
        $actions = parent::actions();
        unset($actions['index'],$actions['create'],$actions['update'],$actions['delete'],$actions['view']);

        return $actions;
    }
    public function actionIndex($device_id){

        if(Variable::IsOwner($device_id) == true)
        {
            $activeData = new ActiveDataProvider([
                'query' => Variable::find()->where('device_id = '.$device_id)
            ]);
            return $activeData;
        }
        throw new UnauthorizedHttpException(404);
    }
}
