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
use yii\helpers\ArrayHelper;

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
        Yii::$app->user->getId();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->getId();
            if($model->save())
                return $this->redirect(['manage', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->getId();
            if($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionUpdateproject($id,$project)
    {
        $model = $this->findModel($id);
        $project_app = new ProjectAppRelation();
        $project_app->app_id = $model->id;
        $project_app->project_id = $project;
        $project_app->user_id = Yii::$app->user->getId();
        $project_app->save();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['manage', 'id' => $model->id]);
        }
    }

    public function actionManage($id){
        $model = $this->findModel($id);
        $items = ArrayHelper::map(Project::find()->all(), 'id', 'name');
        $project = new Project();
        $projectProvider = new ActiveDataProvider(['query' => $model->getProjects()]);
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->getId();
            if($model->save())
            return $this->redirect(['manage', 'id' => $model->id]);
        }

        return $this->render('manage',[
            'model' => $model,
            'project' => $project,
            'projectProvider' => $projectProvider,
            'items' => $items
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
