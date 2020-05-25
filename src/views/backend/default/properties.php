<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use portalium\device\Module;
use yii\helpers\Url;
use yii\bootstrap\modal;
use portalium\theme\widgets\GridView;
/* @var $this yii\web\View */
/* @var $type portalium\device\models\Type */
/* @var $properties portalium\device\models\Properties */
/* @var $variable portalium\device\models\Variable*/
/* @var $form yii\widgets\ActiveForm */

$this->title = Module::t('Device Properties');
?>

<div class="device-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($properties, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($properties, 'description')->textarea(['rows' => 1]) ?>

    <?= $form->field($properties, 'format')->dropDownList([$properties->getTypes()])?>

    <?= $form->field($properties, 'value')->textarea(['rows' => 1]) ?>


    <div class="form-group">
        <?= Html::submitButton(Module::t('Save'), ['type'],['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>