<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\navbar\models\Navbar;
use backend\modules\files\models\Qiniu;


/* @var $this yii\web\View */
/* @var $model backend\modules\navbar\models\FronBanner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fron-banner-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group files-insert">
        <ul class="image-items">
            <?php if(!$model->isNewRecord) : ?>
                <li class="item item-<?=$model->files->id?>">
                    <img src="<?= (new Qiniu)->auth->privateDownloadUrl($model->files->host .DIRECTORY_SEPARATOR .$model->files->name) ?>"/>
                    <i class="fa fa-times-circle image-close"></i>
                </li>
            <?php endif; ?>
        </ul>
        <ul class="input-items">
            <?= $form->field($model, 'fid')->hiddenInput(['maxlength' => true])->label(false) ?>
        </ul>
        <ul class="clearfix"></ul>
        <button type="button" class="btn btn-default" onclick="selectFilesDialog({ele:this,num:1,type:1,name:'FronBanner[fid]'})">
            <i class="fa fa-file-image-o" style="color:#dd551a;"></i><span class="hidden-xs">&nbsp;添加图片</span>
        </button>
    </div>

    <?= $form->field($model, 'tid')->widget('getpu\tree\TreeViewInput',[
        'name' => 'FronBanner[tid]',
        'value' => 'true', // preselected values
        'query' => Navbar::findOne(['name' => '网站横幅'])->children(),
        'headingOptions' => ['label' => '分类导航'],
        'rootOptions' => ['label'=>'<i class="fa fa-tree text-success"></i>'],
        'fontAwesome' => true,
        'asDropdown' => true,
        'multiple' => false,
        'options' => ['disabled' => false],
    ]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= $this->render('@backend/modules/files/views/file/layout') ?>

<?php
$css = <<<CSS
.files-insert{ width:100%; height:320px; border:1px #e5e5e5 solid; background-color:#fff; margin:0; padding:0; position:relative;}
.files-insert .image-items {list-style:none;display:block;overflow:hidden;height:320px;margin:0;padding:0;}
.files-insert .image-items .item{padding:30px;}
.files-insert .image-items .item img{position:relative;width:100%;height:260px;z-index:1;}
.files-insert .image-items .item .image-close{position:absolute;top:16px;right:16px;cursor:pointer;font-size:18px;color:#e05a5a;}
.files-insert .image-items .item .image-close:hover{color:#cc1515;}
.files-insert button{position:absolute;top:35%;left:45%;z-index:0;}
.files-insert .has-error{position:absolute;top:45%;left:45%;}
CSS;
$this->registerCss($css);
?>