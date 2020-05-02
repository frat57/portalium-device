<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use portalium\device\Module;
/* @var $this yii\web\View */
/* @var $searchModel portalium\device\models\DeviceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('Devices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('Create Device'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'api',
            'description:ntext',
            'type',
            //'properties',
            //'variable',
            //'tag',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
