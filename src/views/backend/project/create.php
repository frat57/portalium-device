<?php

use yii\helpers\Html;
use portalium\device\Module;
/* @var $this yii\web\View */
/* @var $model portalium\device\models\Project */

$this->title = Module::t('Create Project');
$this->params['breadcrumbs'][] = ['label' => Module::t('Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
