<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Device */

$this->title = Yii::t('app', 'Create Device List');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listem'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="listem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>