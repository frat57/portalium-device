<?php

namespace portalium\device\controllers\api;

use Yii;
use portalium\device\models\Variable;
use portalium\device\models\Data;
use portalium\rest\ActiveController as RestActiveController;
use yii\data\ActiveDataProvider;

class DatasController extends RestActiveController
{
    public $modelClass = 'portalium\device\models\Data';

    public function actions(){
        $actions = parent::actions();
        unset($actions['index'],$actions['create'],$actions['update'],$actions['delete'],$actions['view']);

        return $actions;
    }
    public function actionIndex($variable_id){

        if(Data::IsOwner($variable_id) == true)
        {
            $activeData = new ActiveDataProvider([
                'query' => Data::find()->where('variable_id=' .$variable_id)
            ]);
            return $activeData;
        }
        return null;
    }
    public function actionCreate($variable_id,$value)
    {
        $model = new Data();
        $model->variable_id = $variable_id;
        $model->value = $value;
        if(Data::IsOwnerVariable($variable_id) == true) {
            if ($model->save()){
                return $model;
            }
            else{
                return $this->modelError($model);
            }
        }
        return null;
    }

}
