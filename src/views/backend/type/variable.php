<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use portalium\device\Module;
use portalium\device\models;
use portalium\theme\widgets\GridView;

/* @var $this yii\web\View */
/* @var $type portalium\device\models\Type */
/* @var $form yii\widgets\ActiveForm */
/* @var $model portalium\device\models\Variable */
?>

<div class="variable-form">

    <?php $form = ActiveForm::begin(['action' => Url::toRoute(['variable/create','id' => $type])]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'api')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'unit')->textarea(['rows' => 1])?>


    <div class="form-group">
        <?= Html::submitButton(Module::t('Save'), ['type'],['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?=GridView::widget([
    'dataProvider' => $provider,
        'summary'=> false,
        'columns' => [

            'name',
            'api',
            'unit',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{delete}',
                'buttons' => [
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
