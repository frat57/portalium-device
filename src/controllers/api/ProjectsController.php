<?php

namespace portalium\device\controllers\api;

use Yii;
use portalium\device\models\Project;
use portalium\device\Module;
use portalium\rest\ActiveController;
use yii\data\ActiveDataProvider;
use portalium\user\models\User;
use yii\web\Linkable;


class ProjectsController extends ActiveController
{
    public $modelClass = 'portalium\device\models\Project';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'], $actions['index'], $actions['view']);
        return $actions;
    }
    public function actionView($id){
        if(Project::IsOwner($id) == true) {
            $dataProvider = new ActiveDataProvider([
                'query' =>  Project::find()->where('id = '.$id)
            ]);
            return $dataProvider;
        }
        return null;
    }

    public function actionCreate()
    {
        $model = new Project();

        if($model->load(Yii::$app->getRequest()->getBodyParams(),'')) {
             $model->user_id = Yii::$app->user->identity->getId();
            if($model->save())
                return $model;
            else
                return $this->modelError($model);
        }else{
            return $this->error(Module::t("Name required."));
        }
    }
    public function actionIndex($user_id){

            $projectProvider = new ActiveDataProvider([
                'query' =>  Project::find()->where('user_id = '.$user_id)
            ]);
            return $projectProvider;
    }
}
