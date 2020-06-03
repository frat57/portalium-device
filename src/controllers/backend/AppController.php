<?php

namespace portalium\device\controllers\backend;

use portalium\device\models\Project;
use portalium\device\models\ProjectAppRelation;
use portalium\device\models\Variable;
use Yii;
use portalium\device\models\App;
use portalium\device\models\AppSearch;
use portalium\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class AppController extends Controller
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
        $searchModel = new AppSearch();
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
        $model = new App();

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

    public function actionManage($id){
        $model = $this->findModel($id);
        $project = new Project();
        $projectProvider = new ActiveDataProvider(['query' => $model->getProjects()]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['manage', 'id' => $model->id]);
        }

        return $this->render('manage',[
            'model' => $model,
            'project' => $project,
            'projectProvider' => $projectProvider,
        ]);
    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = App::findOne($id)) !== null) {
            return $model;
        }
        if (($project = Project::findOne($id)) !== null) {
            return $project;
        }
        throw new NotFoundHttpException(Module::t('The requested page does not exist.'));
    }
}
