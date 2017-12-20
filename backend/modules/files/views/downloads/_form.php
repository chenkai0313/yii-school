<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\cms\models\Space;
use backend\modules\cms\models\FronCategory;

/* @var $this yii\web\View */
/* @var $model backend\modules\files\models\FronDownloads */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fron-downloads-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cid')->widget('\getpu\tree\TreeViewInput', [
        'name' => 'FronDownloads[cid]',
        'value' => true,
        'query' => FronCategory::findOne(Space::$cid)->children(),
        'headingOptions' => ['label' => '分类导航'],
        'rootOptions' => ['label'=>'<i class="fa fa-tree text-success"></i>'],
        'fontAwesome' => true,
        'asDropdown' => true,
        'multiple' => false,
        'options' => ['disabled' => false],
    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mime')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
