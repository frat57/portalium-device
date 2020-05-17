<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use portalium\device\Module;
/* @var $this yii\web\View */
/* @var $model portalium\device\models\Device */
/* @var $type portalium\device\models\Type */
/* @var $properties portalium\device\models\Properties */
/* @var $variable portalium\device\models\Variable*/
/* @var $tag portalium\device\models\Tag */
/* @var $form yii\widgets\ActiveForm */

$this->title = Module::t('Tag');

?>
<div class="tag-create">
    <h1><?= Html::encode($this->title) ?></h1>

   <?= $this->render('_tag', [
        'tag' => $tag,
        'tagProvider' => $tagProvider,
    ]) ?>

</div>
