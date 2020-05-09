<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use portalium\device\Module;
use portalium\device\models;

/* @var $this yii\web\View */
/* @var $type portalium\device\models\Type */
/* @var $form yii\widgets\ActiveForm */
/* @var $properties portalium\device\models\Properties */
?>

<div class="type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($properties, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($properties, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($properties, 'format')->dropDownList([$properties->getTypes()])?>

    <?= $form->field($properties, 'value')->textarea(['rows' => 1]) ?>


    <div class="form-group">
        <?= Html::submitButton(Module::t('Save'), ['create'],['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
