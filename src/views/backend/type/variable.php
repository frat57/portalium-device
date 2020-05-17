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

<div class="type-form">

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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'api',
            'unit',

            ['class' => 'yii\grid\ActionColumn'],
            ]
    ]);
    ?>

</div>
