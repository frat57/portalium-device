<?php

use yii\helpers\Html;
use portalium\device\Module;
use portalium\theme\widgets\Tabs;
/* @var $this yii\web\View */
/* @var $model portalium\device\models\Device */


$this->params['breadcrumbs'][] = ['label' => Module::t('Device'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('Update');
?>
<div class="device-update">

    <h1><?= Html::encode($this->title) ?></h1>

   <?= $this->render('update', [
           'model' => $model
       ])
   ?>
    <?= $this->render('_list_item', [
        'model' => $model
    ])
    ?>

</div>
