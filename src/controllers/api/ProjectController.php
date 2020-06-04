<?php

namespace portalium\device\controllers\api;

use portalium\device\models\Project;
use portalium\rest\ActiveController as RestActiveController;
use yii\data\ActiveDataProvider;


class ProjectController extends RestActiveController
{
    public $modelClass = 'portalium\device\models\Project';

}
