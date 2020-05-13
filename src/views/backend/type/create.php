<?php

use yii\helpers\Html;
use portalium\device\Module;
/* @var $this yii\web\View */
/* @var $model portalium\device\models\Type */

$this->title = Module::t('Create Type');
$this->params['breadcrumbs'][] = ['label' => Module::t('Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
