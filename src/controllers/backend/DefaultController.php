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
    public function actionProperties($id){
        $properties = new Properties();
        $properties->device_id = $id;
        if ($properties->load(Yii::$app->request->post()) && $properties->save()) {
            return $this->redirect(['default/manage', 'id' => $id]);
        }

    }
    //Variable için create type controller
    public function actionVariable($id){
        $variable = new Variable();
        $variable->device_id = $id;
        $variableQuery = Tag::find()->where(['device_id' => $id]);
        $variableProvider = new ActiveDataProvider(['query' => $variableQuery]);
        if ($variable->load(Yii::$app->request->post()) && $variable->save()) {
            return $this->redirect(['default/manage', 'id' => $id]);
        }
        return $this->render('variable', [
            'variable' => $variable,
            'variableProvider' => $variableProvider
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
        $type = new Type();
        $typeQuery = Type::find();
        $typeProvider = new ActiveDataProvider(['query' => $typeQuery]);
        $variable = new Variable();
        $variableQuery = Variable::find()->where(['device_id' => $id]);
        $variableProvider = new ActiveDataProvider(['query' => $variableQuery ,
            'pagination' => [
                'pageSize' => 10,
            ],
            ]);
        $properties = new Properties();
        $propertiesQuery = Properties::find()->where(['device_id' => $id]);
        $propertiesProvider = new ActiveDataProvider(['query' => $propertiesQuery]);
        $tag = new Tag();
        $tagQuery = Tag::find()->where(['device_id' => $id]);
        $tagProvider = new ActiveDataProvider(['query' => $tagQuery]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['manage', 'id' => $model->id]);
        }

        return $this->render('manage',[
            'model' => $model,
            'variable' => $variable,
            'variableProvider' => $variableProvider,
            'properties' => $properties,
            'propertiesProvider' => $propertiesProvider,
            'tag' => $tag,
            'tagProvider' => $tagProvider,
            'type' => $type,
            'typeProvider' => $typeProvider,
        ]);
    }

    public function actionTypeupdate($id)
    {
        $type = Type::findOne($id);
        $type->device_id = $id;
        $type->save();
        if ($type->load(Yii::$app->request->post()) && $type->save()) {
            return $this->redirect(['default/manage', 'id' => $type->id]);
        }

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
        if (($properties = Properties::findOne($id)) !== null) {
            return $properties;
        }
        if (($variable = Variable::findOne($id)) !== null) {
            return $variable;
        }
        if (($type = Type::findOne($id)) !== null) {
            return $type;
        }


        throw new NotFoundHttpException(Module::t('The requested page does not exist.'));
    }
}
