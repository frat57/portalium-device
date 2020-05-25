<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use portalium\device\Module;
use portalium\device\models;
use portalium\theme\widgets\GridView;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model portalium\device\models\Device */
?>

<div class="type-form">

    <?php $form = ActiveForm::begin(['action' => Url::toRoute(['project/create','id' => $device])]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'api')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 1])?>


    <div class="form-group">
        <?= Html::submitButton(Module::t('Save'), ['type'],['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?=GridView::widget([
        'dataProvider' => $Provider,
        'summary'=> false,
        'columns' => [

            'name',
            'api',
            'description',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::toRoute(['default/view','id' => $model->id]), [
                            'title' => Module::t('device-view'),
                        ]);
                    },

                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::toRoute(['default/manage','id' => $model->id]), [
                            'title' => Module::t('device-update'),
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
            ],
        ],
    ]); ?>

</div>
