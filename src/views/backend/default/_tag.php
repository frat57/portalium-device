<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use portalium\device\Module;
use portalium\device\models;
use dosamigos\selectize\SelectizeTextInput;
/* @var $this yii\web\View */
/* @var $type portalium\device\models\Type */
/* @var $form yii\widgets\ActiveForm */
/* @var $tag portalium\device\models\Tag */
?>

<div class="device-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'tagNames')->widget(SelectizeTextInput::className(), [
        // calls an action that returns a JSON object with matched
        // tags
        'loadUrl' => ['tag/list'],
        'options' => ['class' => 'form-control'],
        'clientOptions' => [
            'plugins' => ['remove_button'],
            'valueField' => 'name',
            'labelField' => 'name',
            'searchField' => ['name'],
            'create' => true,
        ],
    ])->hint('Use commas to separate tags') ?>


    <?php ActiveForm::end(); ?>

</div>
