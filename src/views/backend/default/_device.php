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

                <?= $this->render('_tag', [
                    'tag' => $tag,
                    'tagProvider' => $tagProvider,
                    'device' => $model->id
                ])
                ?>

                <?php Pjax::begin(['id' => 'properties']) ?>
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
                <p>
                    <?= Html::a(Module::t('Add Properties'), ['properties', 'id' => $device ], ['class' => 'btn btn-success']) ?>
                </p>

                <?php Pjax::end() ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

