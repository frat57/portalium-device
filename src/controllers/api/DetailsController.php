<?php

namespace portalium\device\controllers\api;

use MongoDB\Driver\Exception\AuthenticationException;
use Yii;
use portalium\device\models\Detail;
use portalium\rest\ActiveController as RestActiveController;
use yii\data\ActiveDataProvider;

class DetailsController extends RestActiveController
{
    public $modelClass = 'portalium\device\models\Detail';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'],$actions['create'],$actions['update'],$actions['delete'],$actions['view']);
        return $actions;
    }
    public function actionView($project_id)
    {

        if (Detail::IsOwner($project_id))
        {
            $activeData = new ActiveDataProvider([
                'query' => Detail::find()->where('project_id='.$project_id)
            ]);
            return $activeData;
        }
        throw new AuthenticationException(404,'message');
    }
    public function actionCreate()
    {
        $model = new Detail();

        if($model->load(Yii::$app->getRequest()->getBodyParams(),'')){
            $model->user_id = Yii::$app->user->identity->getId();
            if ($model->save()){
                return $model;
            }
            else{
                return $this->modelError($model);
            }
        }else{
            return $this->error(Module::t("missing requirements."));
        }
    }

}
