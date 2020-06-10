<?php
// _list_item.php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
/* @var $model portalium\device\models\Device */
?>

<article style="width:25%;border:solid 1px #cccccc;float: left;"
         class="item" data-key="<?= $model->id; ?>">
    <div style="float: left;">
        <div style="width: 500px;">
    <h2 class="title">
        <?= Html::a(Html::encode($model->name), Url::toRoute(['default/variable', 'id' => $model->id])) ?>
    </h2>

        <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <div class="caption">
                        <h3><?= Html::encode($model->name); ?></p></h3>
                        <?= Html::encode($model->description); ?>
                       <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                           ['default/variable','id' => $model->id]);
                       ?>
                        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['default/variablesdelete', 'id' => $model->id ,'device_id' => $device_id], [
                            'class' => '',
                            'data' => [
                                'confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.',
                                'method' => 'post',
                            ],
                        ]); ?>
                    </div>
                </div>
        </div>
    </div>
        </div>

</article>