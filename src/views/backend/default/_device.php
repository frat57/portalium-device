<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use portalium\device\Module;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\modal;
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
                <?php Modal::begin([
                    'header' => '<h2>Select Type</h2>',
                    'toggleButton' => ['class' =>  'btn btn-primary','label'=>'Select Type']
                ]); ?>

                <?php Modal::end(); ?>

                <?= $this->render('_tag', [
                    'tag' => $tag,
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
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::toRoute(['properties','id' => $model->id]) ,[
                                        'title' => Module::t('View'),
                                            ]);
                                },
                                'delete' => function($url, $model){
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
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

            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

    <div class="properties-form">
        <p>
            <?php Modal::begin([
                'header' => '<h2>Create Properties</h2>',
                'toggleButton' => ['class' =>  'btn btn-success','label'=>'Add Properties']
            ]); ?>
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($properties, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($properties, 'key')->textarea(['rows' => 1]) ?>

            <?= $form->field($properties, 'description')->textarea(['rows' => 1]) ?>

            <?= $form->field($properties, 'format')->dropDownList($properties->getTypes()) ?>

        <div class="form-group">
            <?= Html::submitButton(Module::t('Save'), ['create'],['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <?php Modal::end(); ?>
        </p>
    </div>

</div>

