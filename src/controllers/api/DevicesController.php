<?php

namespace portalium\device\controllers\api;

use portalium\device\models\Device;
use portalium\rest\ActiveController as RestActiveController;
use yii\data\ActiveDataProvider;
use yii\web\UnauthorizedHttpException;

class DevicesController extends RestActiveController
{
    public $modelClass = 'portalium\device\models\Device';
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'],$actions['create'],$actions['update'],$actions['delete'],$actions['view']);
        return $actions;
    }
    public function actionIndex($project_id)
    {
        if(Device::IsOwnerProject($project_id)){
            $activeData = new ActiveDataProvider([
                'query' => Device::find()->where('project_id = '.$project_id)
            ]);
            return $activeData;
        }
        throw new UnauthorizedHttpException(404);
    }
    public function actionView($id)
    {
        if(Device::IsOwner($id)) {
            $activeData = new ActiveDataProvider([
                'query' => Device::find()->where('id = ' .$id)
            ]);
            return $activeData;
        }
        return null;
    }
}
