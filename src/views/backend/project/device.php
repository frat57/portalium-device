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
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'api',
            'description',

            ['class' => 'yii\grid\ActionColumn'],
        ]
    ]);
    ?>

</div>
