<?php

namespace portalium\device\controllers\api;

use Yii;
use portalium\device\models\Properties;
use portalium\rest\ActiveController as RestActiveController;
use yii\data\ActiveDataProvider;
use yii\web\UnauthorizedHttpException;

class PropertiesController extends RestActiveController
{
    public $modelClass = 'portalium\device\models\Properties';

    public function actions(){
        $actions = parent::actions();
        unset($actions['index'],$actions['create'],$actions['delete'],$actions['view']);

        return $actions;
    }
    public function actionIndex($device_id){

        if(Properties::IsOwnerDevice($device_id) == true)
        {
            $activeData = new ActiveDataProvider([
                'query' => Properties::find()->where('device_id = '.$device_id)
            ]);
            return $activeData;
        }
        throw new UnauthorizedHttpException(404);
    }
    public function actionUpdate($id)
    {
        $model = Properties::findOne($id);

        if(Properties::IsOwner($id)){
            if($model->load(Yii::$app->getRequest()->getBodyParams(),'')) {
                if($model->save())
                    return $model;
                else
                    return $this->modelError($model);
            }else{
                return $this->error(Module::t("Name required."));
            }

        }throw new UnauthorizedHttpException(404);
    }
    public function actionView($id){

        if(Properties::IsOwner($id) == true) {
            $activeData = new ActiveDataProvider([
                'query' => Properties::find()->where('id = ' .$id)
            ]);
            return $activeData;
        }
        throw new UnauthorizedHttpException(404);
    }
}
