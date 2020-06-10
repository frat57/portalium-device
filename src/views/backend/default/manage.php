<?php

use yii\helpers\Html;
use portalium\device\Module;
use portalium\theme\widgets\Tabs;
use yii\widgets\ListView;
use yii\bootstrap\modal;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $model portalium\device\models\Device */

$this->params['breadcrumbs'][] = ['label' => Module::t('Device'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('Update');
?>
<div class="device-update"style="float: left;width: 25%">

    <h1><?= Html::encode($this->title) ?></h1>
   <?= $this->render('_device', [
       'model' => $model,
       'tagProvider' => $tagProvider,
       'properties' => $properties,
       'typeProvider' => $typeProvider,
       'propertiesProvider' => $propertiesProvider,
       ])
   ?>
    </div>

<div class="device-list" style="float: left;width: 75%">
    <?=
    ListView::widget([
        'dataProvider' => $variableProvider,
        'viewParams' => [ 'device_id' => $model->id ],
        'options' => [
            'tag' => 'div',
            'class' => 'list-wrapper',
            'id' => 'list-wrapper',
        ],
        'summary'=> false,
        'itemView' => '_list_variable',
    ]);
    ?>
</div>
