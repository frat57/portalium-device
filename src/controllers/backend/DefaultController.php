<?php

namespace portalium\device\controllers\backend;

use portalium\device\models\Project;
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
use yii\helpers\ArrayHelper;


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
    //Properties için create  controller
    public function actionProperties($id){
        $properties = new Properties();
        $properties->device_id = $id;
        if ($properties->load(Yii::$app->request->post()) && $properties->save()) {
            return $this->redirect(['default/manage', 'id' => $id]);
        }

    }
    //Properties için update controller
    public function actionPropertiesupdate($id){
        $model = $this->findPropertiesModel($id);
        //Hangi device olduğuna dönmek için
        $device = $model->device_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['default/manage', 'id' => $device]);
        }
        return $this->render('_properties', [
            'model' => $model,
        ]);

    }
    public function actionPropertiesdelete($id)
    {
        $properties = Properties::findOne($id);
        $device_id = $properties->device_id;
        $this->findPropertiesModel($id)->delete();

        return $this->redirect(['manage','id' => $device_id]);
    }
    public function actionVariablesdelete($id,$device_id)
    {
        $this->findVariableModel($id)->delete();

        return $this->redirect(['manage','id' => $device_id]);
    }
    public function actionCreatevariable(){
        $variable = new Variable();

        if ($variable->load(Yii::$app->request->post()) && $variable->save()) {
            return $this->redirect(['default/manage', 'id' => $variable->id]);
        }
        return $this->render('variable', [
            'variable' => $variable,
        ]);

    }
    //Variable için create type controller
    public function actionVariable($id){
        $variable = new Variable();
        $variable->device_id = $id;
        $variableQuery = Variable::find()->where(['device_id' => $id]);
        $variableProvider = new ActiveDataProvider(['query' => $variableQuery]);
        if ($variable->load(Yii::$app->request->post()) && $variable->save()) {
            return $this->redirect(['default/manage', 'id' => $variable->id]);
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
        $typeQuery = Type::find();
        $typeProvider = new ActiveDataProvider(['query' => $typeQuery]);

        $variableQuery = Variable::find()->where(['device_id' => $id]);
        $variableProvider = new ActiveDataProvider(['query' => $variableQuery ,
            'pagination' => [
                'pageSize' => 10,
            ],
            ]);
        $properties = new Properties();
        $propertiesQuery = Properties::find()->where(['device_id' => $id]);
        $propertiesProvider = new ActiveDataProvider(['query' => $propertiesQuery]);

        $tagQuery = Tag::find()->where(['device_id' => $id]);
        $tagProvider = new ActiveDataProvider(['query' => $tagQuery]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['manage', 'id' => $model->id]);
        }

        return $this->render('manage',[
            'model' => $model,
            'variableProvider' => $variableProvider,
            'properties' => $properties,
            'propertiesProvider' => $propertiesProvider,
            'tagProvider' => $tagProvider,
            'typeProvider' => $typeProvider,
        ]);
    }

    public function actionTypeupdate($id,$d_id)
    {
        $model = $this->findModel($d_id);
        $model->type_id = $id;

        //code goes here
        //variable tablosundan ilgili type_id ile ilişkili kayıtlar çekilir.
        $variables = Variable::find()->where(['type_id'=> $id])->asArray()->all();
        foreach ($variables as $variable) {
            $newvariable = new Variable();
            $newvariable->name = $variable['name'];
            $newvariable->api = $variable['api'];
            $newvariable->description = $variable['description'];
            $newvariable->range = $variable['range'];
            $newvariable->unit = $variable['unit'];
            $newvariable->type_id = 0;
            $newvariable->device_id = $d_id;
            if($newvariable->validate())
            $newvariable->save();
        }
        //Çekilen kayıtların kopyaları bu sefer type_id = 0 yapılıp
        // device_id leri ilgili device_id olucak şekilde yeni kayıt olarak eklenir.
        $properties = Properties::find()->where(['type_id'=> $id])->asArray()->all();
        foreach ($properties as $propertie) {
            $newproperties = new Properties();
            $newproperties->name = $propertie['name'];
            $newproperties->key = $propertie['key'];
            $newproperties->description = $propertie['description'];
            $newproperties->format = $propertie['format'];
            $newproperties->value = $propertie['value'];
            $newproperties->type_id = 0;
            $newproperties->device_id = $d_id;
            if($newproperties->validate())
            $newproperties->save();
        }

        if ($model->save()) {
            return $this->redirect(['default/manage', 'id' => $d_id]);
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

        throw new NotFoundHttpException(Module::t('The requested page does not exist.'));
    }
    protected function findPropertiesModel($id)
    {
        if (($model = Properties::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Module::t('The requested page does not exist.'));
    }
    protected function findVariableModel($id)
    {
        if (($model = Variable::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Module::t('The requested page does not exist.'));
    }
}
