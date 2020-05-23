<?php
namespace portalium\device\controllers\backend;

use portalium\device\models\Type;
use portalium\device\models\Variable;
use portalium\web\Controller;
use Yii;

class DeviceController extends Controller
{

    public function actionCreate($id)
    {
        $model = new Device();
        $model->device_id = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['project/manage', 'id' => $id ]);
        }
    }
    protected function findModel($id)
    {
        if (($model = Device::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Module::t('The requested page does not exist.'));
    }
}