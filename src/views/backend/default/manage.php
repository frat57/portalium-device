<?php

use yii\helpers\Html;
use portalium\device\Module;
use portalium\theme\widgets\Tabs;
use yii\widgets\ListView;
/* @var $this yii\web\View */
/* @var $model portalium\device\models\Device */
require_once "sidebar.php";

$this->params['breadcrumbs'][] = ['label' => Module::t('Device'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('Update');
?>
<div class="device-update"style="float: left;width: 25%">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="sidenav">
   <?= $this->render('update', [
       'model' => $model,
       'tag' => $tag,
       'tagProvider' => $tagProvider,
       'properties' => $properties,
       'propertiesProvider' => $propertiesProvider,
       'device' => $model->id
       ])
   ?>
    </div>
</div>
<div class="device-list" style="float: left;width: 75%">
    <?=
    ListView::widget([
        'dataProvider' => $variableProvider,
        'options' => [
            'tag' => 'div',
            'class' => 'list-wrapper',
            'id' => 'list-wrapper',
        ],
        'summary'=> false,
        'itemView' => function ($variable, $key, $index, $widget) {
            return $this->render('_list_variable', ['model' => $variable]);
        },

    ]);
    ?>
</div>
</div>
