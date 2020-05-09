<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use portalium\device\Module;
/* @var $this yii\web\View */
/* @var $type portalium\device\models\Type */
/* @var $properties portalium\device\models\Properties */
/* @var $variable portalium\device\models\Variable*/
/* @var $form yii\widgets\ActiveForm */

$this->title = Module::t('Create Type');
$this->params['breadcrumbs'][] = ['label' => Module::t('Type'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_type', [
        'type' => $type,
        'variable' => $variable,
        'properties' => $properties,
    ]) ?>

</div>
