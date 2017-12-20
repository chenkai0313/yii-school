<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use getpu\ueditor\UEditor;

/**
 * Created by getpu on 16/9/6.
 */

?>

    <div class="fron-entrepreneurial-form">

        <?php $form = ActiveForm::begin([]) ?>

        <div class="col-xs-12 col-md-9 panel panel-default">
            <div class="panel-body">

                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                
                <?= $form->field($model, 'tag')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'desc')->textarea(['maxlength' => true, 'rows' => 6, 'style' => 'resize:vertical']) ?>

            </div>
        </div>

        <div class="col-xs-12 col-md-3 panel panel-default">
            <div class="panel-body">

                <div class="form-group files-insert">
                    <ul class="image-items">
                        <?php if(!$model->isNewRecord) : ?>
                            <li class="item item-<?=$model->files->id?>">
                                <img src="<?= $model->files->host .DIRECTORY_SEPARATOR .$model->files->name ?>"/>
                                <i class="fa fa-times-circle image-close"></i>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <ul class="input-items">
                        <?= $form->field($model, 'fid')->hiddenInput(['maxlength' => true])->label(false) ?>
                    </ul>
                    <ul class="clearfix"></ul>
                    <button type="button" class="btn btn-default" onclick="selectFilesDialog({ele:this,num:1,type:1,name:'Teacher[fid]'})">
                        <i class="fa fa-file-image-o" style="color:#dd551a;"></i><span class="hidden-xs">头像</span>
                    </button>
                </div>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <?php ActiveForm::end() ?>

        <div class="clearfix"></div>

    </div>

<?= $this->render('@backend/modules/files/views/file/layout') ?>

<?php
$css = <<<CSS
.panel-default .fixed{position:fixed;height:inherit;background-color:#fff;}
.files-insert {width:100%;height:220px;border:1px #d8d8d8 dashed;position:relative;overflow:hidden;}
.files-insert .btn{position:absolute;top:50%;left:50%;margin:-17px 0 0 -33px;display:inline;}
.files-insert .image-items {display:block;overflow:hidden;list-style:none;padding:0;margin:0;}
.files-insert .image-items .item {padding:15px;}
.files-insert .image-items .item img{position:relative; width:100%; height:190px;z-index:1;}
.files-insert .image-items .image-close {position:absolute;top:3px;right:3px;cursor:pointer;font-size:16px;color:#e05a5a;}
.files-insert .image-items .image-close:hover{color:#cc1515;}
.files-insert .input-items .has-error{position:absolute;top:50%;left:50%;margin:-40px 0 0 -43px;}
CSS;
$this->registerCSS($css);
?>