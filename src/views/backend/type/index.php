<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use portalium\device\Module;
/* @var $this yii\web\View */
/* @var $searchModel portalium\device\models\TypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('Create Type'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'device_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Module::t('type-view'),
                        ]);
                    },

                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Module::t('type-update'),
                        ]);
                    },
                    'delete' => function($url, $model){
            return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                'class' => '',
                'data' => [
                    'confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.',
                    'method' => 'post',
                ],
                 ]); }
                ],

                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url ='type/view?id='.$model->id;
                        return $url;
                    }

                    if ($action === 'update') {
                        $url ='type/manage?id='.$model->id;
                        return $url;
                    }

                }
                ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
