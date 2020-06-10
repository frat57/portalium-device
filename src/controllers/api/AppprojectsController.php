<?php

namespace portalium\device\controllers\api;

use Yii;
use portalium\device\models\AppProject;
use portalium\device\models\App;
use portalium\rest\ActiveController as RestActiveController;
use yii\data\ActiveDataProvider;
use yii\web\UnauthorizedHttpException;

class AppprojectsController extends RestActiveController
{
    public $modelClass = 'portalium\device\models\AppProject';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'],$actions['update'],$actions['view'],$actions['delete']);
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
        throw new UnauthorizedHttpException(404);
    }
    public function actionDelete($id)
    {
        $model = App::findOne($id);
       // $app_projects = AppProject::findOne($id);
        if(App::IsOwner($id)) {
            $model->delete();
           // $app_projects->delete();
        }
        throw new UnauthorizedHttpException(404);
    }
    public function actionView(){

        $user_id = Yii::$app->user->getId();

            $appProvider = new ActiveDataProvider([
                'query' => App::find()->where('user_id = ' .$user_id)
            ]);
            return $appProvider;

    }
}
