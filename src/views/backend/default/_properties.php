<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use portalium\device\Module;
use portalium\device\models;
use portalium\theme\widgets\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $type portalium\device\models\Type */
/* @var $form yii\widgets\ActiveForm */
/* @var $properties portalium\device\models\Properties */
?>
<div class="properties-update">
<div class="properties-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'format')->dropDownList([$model->getTypes()])?>

    <?= $form->field($model, 'value')->textarea(['rows' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton(Module::t('Save'),['type'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>