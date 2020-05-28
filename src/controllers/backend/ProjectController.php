<?php

namespace portalium\device\controllers\backend;

use portalium\device\models\Device;
use portalium\device\models\Properties;
use portalium\device\models\Variable;
use Yii;
use portalium\device\models\Project;
use portalium\device\models\ProjectSearch;
use portalium\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class ProjectController extends Controller
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
        $searchModel = new ProjectSearch();
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
        $model = new Project();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionManage($id){
        $model = $this->findModel($id);
        $device = new Device();
        $deviceQuery = Device::find()->where(['project_id' => $id]);
        $deviceProvider = new ActiveDataProvider(['query' => $deviceQuery]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['manage', 'id' => $model->id]);
        }

        return $this->render('manage',[
            'model' => $model,
            'device' => $device,
            'deviceProvider' => $deviceProvider,
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }
        if (($device = Device::findOne($id)) !== null) {
            return $device;
        }

        throw new NotFoundHttpException(Module::t('The requested page does not exist.'));
    }
}
