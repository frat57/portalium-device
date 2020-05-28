<?php

use yii\helpers\Html;
use portalium\device\Module;
use portalium\theme\widgets\Tabs;
/* @var $this yii\web\View */
/* @var $model portalium\device\models\App */


$this->params['breadcrumbs'][] = ['label' => Module::t('App'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('Update');
?>
<div class="app-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'App',
                'content' => $this->render('update',['model' => $model]),
            ],
            [  'label' => 'Project',
                'content' => $this->render('project',
                    ['model' => $project,
                        'provider'=> $projectProvider ,
                        'app'=> $model->id,
                    ]),
            ]
        ]
    ]);
    ?>

</div>
