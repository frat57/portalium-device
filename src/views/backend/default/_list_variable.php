<?php
// _list_item.php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
/* @var $model portalium\device\models\Device */
?>

<article style="width:25%;border:solid 1px #ccc;float: left;"
         class="item" data-key="<?= $model->id; ?>">
    <div style="float: left;">
        <div style="width: 500px;">
    <h2 class="title">
        <?= Html::a(Html::encode($model->name), Url::toRoute(['default/manage', 'id' => $model->id])) ?>
    </h2>

    <div class="item-excerpt">
        <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="..." alt="...">
                    <div class="caption">
                        <h3><?= Html::encode($model->name); ?></p></h3>
                        <?= Html::encode($model->description); ?>
                        <a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a>

                    </div>
                </div>
        </div>
    </div>
        </div>
    </div>
</article>