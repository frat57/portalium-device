<?php

use yii\helpers\Html;
use portalium\device\Module;
use portalium\theme\widgets\Tabs;
/* @var $this yii\web\View */
/* @var $model portalium\device\models\Type */


$this->params['breadcrumbs'][] = ['label' => Module::t('Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('Update');
?>
<div class="type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'Type',
                'content' => $this->render('update',['model' => $model]),
            ],
            [  'label' => 'Variable',
                'content' => $this->render('variable',
                    ['model' => $variable,
                        'provider'=>$variableProvider ,
                        'type'=>$model->id]),
            ],
            [
                    'label' => 'Properties',
                'content' => $this->render('properties',
                    ['model' => $properties,
                        'provider'=>$propertiesProvider ,
                        'type'=>$model->id]),
            ]
        ]
    ]);
    ?>

</div>
