<?php

use portalium\web\Controller;

class TagController extends Controller{

// On TagController (example)
// actionList to return matched tags
public function actionList($query)
{
    $models = Tag::findAllByName($query);
    $items = [];

    foreach ($models as $model) {
        $items[] = ['name' => $model->name];
    }
    // We know we can use ContentNegotiator filter
    // this way is easier to show you here :)
    Yii::$app->response->format = Response::FORMAT_JSON;

    return $items;
}

}