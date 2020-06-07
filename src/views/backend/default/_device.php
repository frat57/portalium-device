<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use portalium\device\Module;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model portalium\device\models\Device */
/* @var $form yii\widgets\ActiveForm */
/* @var $tag portalium\device\models\Tag */
?>

<div style="float: left;">
    <div style="width: 500px;">
        <div class="col-md-6">
            <div class="device-form">

    <?php Pjax::begin(['id' => 'update_device']) ?>
    <?php $form = ActiveForm::begin([
    'options' => [
            'data' => ['pjax' => true],
            'onkeypress' =>" if(event.keyCode == 13){ submit(); }"
    ],
    ]);?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'api')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end() ?>
            </div>

                <?php Modal::begin([
                    'header' => '<h2>Select Type</h2>',
                    'toggleButton' => ['class' =>  'btn btn-primary','label'=>'Select Type']
                ]); ?>
                <?=
                ListView::widget([
                    'dataProvider' => $typeProvider,
                    'viewParams' => [ 'device' => $model->id ],
                    'options' => [
                        'tag' => 'div',
                        'class' => 'list-wrapper',
                        'id' => 'list-wrapper',
                    ],
                    'summary'=> false,
                    'itemView' => '_list_type',
                ]);
                ?>
                <?php Modal::end(); ?>

                <?= $this->render('_tag', [
                    'model' => $model,
                    'tagProvider' => $tagProvider,
                    'device' => $model->id
                ])
                ?>

                <?= GridView::widget([
                    'dataProvider' => $propertiesProvider,
                    'summary'=> false,
                    'columns' => [

                        'name',
                        'value',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Actions',
                            'headerOptions' => ['style' => 'color:#337ab7'],
                            'template' => '{update}{delete}',
                            'buttons' => [
                                'update' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::toRoute(['propertiesupdate','id' => $model->id]) ,[
                                        'title' => Module::t('properties-update'),
                                        ]);
                                },
                                'delete' => function($url, $model){
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['propertiesdelete', 'id' => $model->id], [
                                        'class' => '',
                                        'data' => [
                                            'confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.',
                                            'method' => 'post',
                                        ],
                                    ]); }
                            ],
                        ],
                    ],
                ]); ?>

            <?php Modal::begin([
                    'id' => 1,
                'header' => '<h2>Create Properties</h2>',
                'toggleButton' => ['class' =>  'btn btn-success','label'=>'Add Properties']
            ]); ?>
            <div class="type-form">
            <?php $form = ActiveForm::begin(['action' => Url::toRoute(['default/properties','id' => $model->id])]); ?>

            <?= $form->field($properties, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($properties, 'key')->textarea(['rows' => 1]) ?>

            <?= $form->field($properties, 'description')->textarea(['rows' => 1]) ?>

            <?= $form->field($properties, 'format')->dropDownList($properties->getTypes()) ?>

        <div class="form-group">
            <?= Html::submitButton(Module::t('Save'), ['create'],['class' => 'btn btn-success']) ?>
        </div>
                <?php ActiveForm::end(); ?>
            </div>
        <?php Modal::end(); ?>
        </div>
    </div>
</div>
