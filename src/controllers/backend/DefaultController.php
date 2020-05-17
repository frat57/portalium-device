<?php

namespace portalium\device\controllers\backend;

use portalium\device\models\Properties;
use portalium\device\models\Variable;
use Yii;
use portalium\device\models\Device;
use portalium\device\models\DeviceSearch;
use portalium\device\models\Tag;
use portalium\device\models\Type;
use portalium\web\Controller;
use portalium\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;


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
    }
    //Properties için create type controller
    public function actionProperties(){
        $properties = new Properties();

        if ($properties->load(Yii::$app->request->post()) && $properties->save()) {
            return $this->redirect(['default/manage', 'id' => $properties->id]);
        }

        return $this->render('properties', [
            'properties'=> $properties,
        ]);
    }
    //Variable için create type controller
    public function actionVariable(){
        $variable = new Variable();

        if ($variable->load(Yii::$app->request->post()) && $variable->save()) {
            return $this->redirect(['default/manage', 'id' => $variable->id]);
        }

        return $this->render('variable', [
            'variable' => $variable,
        ]);
    }
    //Tag için create type controller
    public function actionTag($id){
        $tag = new Tag();
        $tagQuery = Tag::find()->where(['device_id' => $id]);
        $tagProvider = new ActiveDataProvider(['query' => $tagQuery]);
        if ($tag->load(Yii::$app->request->post()) && $tag->save()) {
            return $this->redirect(['default/manage', 'id' => $tag->id]);
        }
        return $this->render('tag', [
            'tag' => $tag,
            'tagProvider' => $tagProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new Device();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['default/manage', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionManage($id){
        $model = $this->findModel($id);
        $variable = new Variable();
        $variableQuery = Variable::find()->where(['device_id' => $id]);
        $variableProvider = new ActiveDataProvider(['query' => $variableQuery]);
        $properties = new Properties();
        $propertiesQuery = Properties::find()->where(['device_id' => $id]);
        $propertiesProvider = new ActiveDataProvider(['query' => $propertiesQuery]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['manage', 'id' => $model->id]);
        }

        return $this->render('manage',[
            'model' => $model,
            'variable' => $variable,
            'variableProvider' => $variableProvider,
            'properties' => $properties,
            'propertiesProvider' => $propertiesProvider
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['default/manage', 'id' => $model->id]);
        }

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

        throw new NotFoundHttpException(Module::t('The requested page does not exist.'));
    }
}
