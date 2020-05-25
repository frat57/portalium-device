<?php

namespace portalium\device\controllers\backend;

use portalium\device\models\Properties;
use Yii;
use portalium\device\models\Type;
use portalium\device\models\TypeSearch;
use portalium\device\models\Variable;
use portalium\web\Controller;
use portalium\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;

class TypeController extends Controller
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
        $searchModel = new TypeSearch();
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

    public function actionCreate()
    {
        $model = new Type();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['type/manage', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionManage($id){
        $model = $this->findModel($id);
        $variable = new Variable();
        $variableQuery = Variable::find()->where(['type_id' => $id]);
        $variableProvider = new ActiveDataProvider(['query' => $variableQuery]);
        $properties = new Properties();
        $propertiesQuery = Properties::find()->where(['type_id' => $id]);
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
            return $this->redirect(['type/manage', 'id' => $model->id]);
        }

    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Type::findOne($id)) !== null) {
            return $model;
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
