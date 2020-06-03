    $this -> registerJs(
        $("document").ready(function(){
            $("#new_properties").on("pjax:end", function() {
                $.pjax.reload({container:"#properties"});  //Reload GridView
            });
        });
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

<div class="properties-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($properties, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($properties, 'value')->textarea(['rows' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton($properties->isNewRecord ? Module::t('Create') : Module::t('Update'), ['class' => $properties->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end();?>
</div>

