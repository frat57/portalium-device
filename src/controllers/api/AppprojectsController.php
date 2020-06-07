<?php

namespace portalium\device\controllers\api;

use portalium\device\models\AppProject;
use portalium\device\models\App;
use portalium\rest\ActiveController as RestActiveController;
use yii\data\ActiveDataProvider;

class AppprojectsController extends RestActiveController
{
    public $modelClass = 'portalium\device\models\AppProject';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'],$actions['update'], $actions['delete']);
        return $actions;
    }
    public function actionIndex($app_id){

        if(AppProject::IsOwner($app_id) == true)
        {
            $projectProvider = new ActiveDataProvider([
                'query' => App::findOne($app_id)->getProjects()
            ]);
            return $projectProvider;
        }
        return 'Yetkisiz Erişim';
    }
}
