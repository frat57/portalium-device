<?php
namespace portalium\device\controllers\backend;

use portalium\device\models\Type;
use portalium\device\models\Properties;
use portalium\web\Controller;
use Yii;

class PropertiesController extends Controller
{

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionCreate($id)
    {
        $model = new Properties();
        $model->type_id = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['type/manage', 'id' => $id , '#' =>'w3-tab1']);
        }
    }
    protected function findModel($id)
    {
        if (($model = Properties::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Module::t('The requested page does not exist.'));
    }
}