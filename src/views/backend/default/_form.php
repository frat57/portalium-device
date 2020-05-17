<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use portalium\device\Module;

/* @var $this yii\web\View */
/* @var $model portalium\device\models\Device */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'action' => ['manage'],
        'method' => 'get',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-2',
                'offset' => 'col-sm-offset-2',
                'wrapper' => 'col-sm-4',
            ],
        ],
    ]); ?>

    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'api')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Module::t('Save'), ['view'],['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
