<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use portalium\device\Module;
/* @var $this yii\web\View */
/* @var $model portalium\device\models\Device */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('Devices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="device-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'api',
            'description:ntext',
            'type',
            'properties',
            'variable',
            'tag',
        ],
    ]) ?>

</div>
