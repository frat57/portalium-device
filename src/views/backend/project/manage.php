<?php

use yii\helpers\Html;
use portalium\device\Module;
use portalium\theme\widgets\Tabs;
/* @var $this yii\web\View */
/* @var $model portalium\device\models\Project */


$this->params['breadcrumbs'][] = ['label' => Module::t('Project'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('Update');
?>
<div class="project-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'Project',
                'content' => $this->render('update',['model' => $model]),
            ],
            [  'label' => 'Device',
                'content' =>$this->render('device',
                    ['model' => $device,
                        'Provider'=>$deviceProvider ,
                        'device'=>$model->id]),
            ],
        ]
    ]);
    ?>



</div>
