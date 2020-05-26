<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use portalium\device\Module;
use portalium\device\models;
/* @var $this yii\web\View */
/* @var $type portalium\device\models\Type */
/* @var $form yii\widgets\ActiveForm */
/* @var $variable portalium\device\models\Variable */

?>

<div class="type-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($variable, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($variable, 'description')->textarea(['rows' => 1]) ?>
        <?= $form->field($variable, 'api')->textInput(['maxlength' => true]) ?>
        <?= $form->field($variable, 'id')->textInput(['input' =>$variable->id])?>
        <?= $form->field($variable, 'range')->textInput(['maxlength' => true]) ?>
        <?= $form->field($variable, 'unit')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton(Module::t('Save'), ['type'],['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
