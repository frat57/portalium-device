<?php

namespace portalium\device\controllers\api;

use portalium\device\models\Device;
use portalium\rest\ActiveController as RestActiveController;
use yii\data\ActiveDataProvider;

class DevicesController extends RestActiveController
{
    public $modelClass = 'portalium\device\models\Device';
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'],$actions['update'],$actions['delete']);
        return $actions;
    }

}
