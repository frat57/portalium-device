<?php

use yii\helpers\Html;
use portalium\device\Module;
/* @var $this yii\web\View */
/* @var $model portalium\device\models\Device */

$this->title = Module::t('Create Device');
$this->params['breadcrumbs'][] = ['label' => Module::t('Devices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
