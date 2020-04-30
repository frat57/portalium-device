<?php

namespace portalium\device\controllers\backend;

use portalium\site\models\DeviceSearch;
use Yii;
use yii\filters\VerbFilter;
use portalium\web\Controller as WebController;

class DefaultController extends WebController
{
    public function actionIndex()
    {
        return $this->redirect('index');
    }

}