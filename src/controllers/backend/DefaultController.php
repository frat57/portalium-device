<?php

namespace portalium\device\controllers\backend;

use portalium\device\models\Properties;
use portalium\device\models\TypeQuery;
use portalium\device\models\Variable;
use Yii;
use portalium\device\models\Device;
use portalium\device\models\DeviceSearch;
use portalium\device\models\Tag;
use portalium\device\models\Type;
use portalium\web\Controller;
use portalium\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use portalium\device\Module;


class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new DeviceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        return $this->render('view', [
            'type' => $this->findModel($id),
        ]);
        return $this->render('view', [
            'properties' => $this->findModel($id),
        ]);
    }
    //Type için create type controller
    public function actionType(){
        $type = new Type();
        $variable = new Variable();
        $properties = new Properties();

        if ($type->load(Yii::$app->request->post()) && $type->save()) {
            return $this->redirect(['view', 'id' => $type->id]);
        }
        if ($variable->load(Yii::$app->request->post()) && $variable->save()) {
            return $this->redirect(['view', 'id' => $variable->id]);
        }
        if ($properties->load(Yii::$app->request->post()) && $properties->save()) {
            return $this->redirect(['view', 'id' => $properties->id]);
        }
        return $this->render('type', [
            'type' => $type,
            'variable' => $variable,
            'properties'=> $properties,
        ]);
    }
    //Properties için create type controller
    public function actionProperties(){
        $type = new Type();
        $variable = new Variable();
        $properties = new Properties();

        if ($type->load(Yii::$app->request->post()) && $type->save()) {
            return $this->redirect(['view', 'id' => $type->id]);
        }
        if ($variable->load(Yii::$app->request->post()) && $variable->save()) {
            return $this->redirect(['view', 'id' => $variable->id]);
        }
        if ($properties->load(Yii::$app->request->post()) && $properties->save()) {
            return $this->redirect(['view', 'id' => $properties->id]);
        }
        return $this->render('properties', [
            'type' => $type,
            'variable' => $variable,
            'properties'=> $properties,
        ]);
    }
    //Variable için create type controller
    public function actionVariable(){
        $type = new Type();
        $variable = new Variable();
        $properties = new Properties();

        if ($type->load(Yii::$app->request->post()) && $type->save()) {
            return $this->redirect(['view', 'id' => $type->id]);
        }
        if ($variable->load(Yii::$app->request->post()) && $variable->save()) {
            return $this->redirect(['view', 'id' => $variable->id]);
        }
        if ($properties->load(Yii::$app->request->post()) && $properties->save()) {
            return $this->redirect(['view', 'id' => $properties->id]);
        }
        return $this->render('variable', [
            'type' => $type,
            'variable' => $variable,
            'properties'=> $properties,
        ]);
    }

    public function actionCreate()
    {
        $model = new Device();
        $type = new Type();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        if ($type->load(Yii::$app->request->post()) && $type->save()) {
            return $this->redirect(['view', 'id' => $type->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
        return $this->render('type', [
            'type' => $type,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $type = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        if ($type->load(Yii::$app->request->post()) && $type->save()) {
            return $this->redirect(['view', 'id' => $type->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
        return $this->render('update', [
            'type' => $type,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Device::findOne($id)) !== null) {
            return $model;
        }
        if (($type = Type::findOne($id)) !== null) {
            return $type;
        }
        if (($properties = Properties::findOne($id)) !== null) {
            return $properties;
        }
        if (($variable = Variable::findOne($id)) !== null) {
            return $variable;
        }

        throw new NotFoundHttpException(Module::t('The requested page does not exist.'));
    }
}
