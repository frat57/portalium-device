<?php

use portalium\device\Module;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DeviceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('Device');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

        <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Device list'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'device_id',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        <?php Pjax::end(); ?>
    </div>

