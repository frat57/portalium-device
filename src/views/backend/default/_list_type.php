<?php
// _list_properties.php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use yii\bootstrap\ActiveForm;
use portalium\device\Module;
use yii\widgets\Pjax;
/* @var $model portalium\device\models\Device */
/* @var $properties portalium\device\models\Properties */
?>

<div class="type-form">
    <?php $form = ActiveForm::begin(['action' => Url::toRoute(['default/typeupdate','id' => $model->id,'d_id' => $device])]); ?>
    <h3><div class="form-group">

   <?= Html::submitButton(Module::t('Update'), ['class' => 'btn btn-primary']) ?>

     <?= Html::encode($model->name); ?></div></h3>
    <?php ActiveForm::end(); ?>
</div>
