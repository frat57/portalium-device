<?php

namespace portalium\device\controllers\api;

use portalium\rest\ActiveController as RestActiveController;
use yii\data\ActiveDataProvider;

class AppprojectsController extends RestActiveController
{
    public $modelClass = 'portalium\device\models\ProjectAppRelation';

}
