<?php

namespace portalium\device\controllers\api;

use portalium\rest\ActiveController as RestActiveController;

class DevicesController extends RestActiveController
{
    public $modelClass = 'portalium\device\models\Device';
}
