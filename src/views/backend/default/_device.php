<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use portalium\device\Module;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model portalium\device\models\Device */
/* @var $form yii\widgets\ActiveForm */
/* @var $tag portalium\device\models\Tag */
?>

<div class="device-form">

    <?php $form = ActiveForm::begin();?>
    <div style="float: left;">
        <div style="width: 500px;">
            <div class="col-md-6">

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'api')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Module::t('Save'), ['class' => 'btn btn-success']) ?>
                </div>

                <?= $this->render('_tag', [
                    'tag' => $tag,
                    'tagProvider' => $tagProvider,
                ])
                ?>

                <?php Pjax::begin(['id' => 'properties']) ?>
                <?= GridView::widget([
                    'dataProvider' => $propertiesProvider,
                    'summary'=> false,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'name',
                        'value',
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
                <?= $this->render('_properties', [
                    'properties' => $properties,
                    'propertiesProvider' => $propertiesProvider,
                ])
                ?>
                <?php Pjax::end() ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
