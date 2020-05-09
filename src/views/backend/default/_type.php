<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use portalium\device\Module;

/* @var $this yii\web\View */
/* @var $type portalium\device\models\Type */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="type-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <?= Html::a(Module::t('Add Properties'), ['properties'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('Add Variables'), ['variable'], ['class' => 'btn btn-primary']) ?>,
    </div>

    <?= $form->field($type, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($type, 'api')->textInput(['maxlength' => true]) ?>

    <?= $form->field($type, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Module::t('Save'), ['view'],['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
