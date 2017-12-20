<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use getpu\ueditor\UEditor;
use dosamigos\datetimepicker\DateTimePicker;
use backend\modules\cms\models\FronCategory;
use backend\modules\cms\models\Activity;
/**
 * Created by getpu on 16/9/6.
 */

?>

<div class="fron-entrepreneurial-form">

    <?php $form = ActiveForm::begin([]) ?>

    <div class="col-xs-12 col-md-9 panel panel-default">
        <div class="panel-body">
            <?= $form->field($model, 'cid')->widget('getpu\tree\TreeViewInput',[
                'name' => 'FronArticle[cid]',
                'value' => true,
                'query' => FronCategory::findOne(Activity::$cid)->children(1),
                'headingOptions' => ['label' => '分类导航'],
                'rootOptions' => ['label'=>'<i class="fa fa-tree text-success"></i>'],
                'fontAwesome' => true,
                'asDropdown' => true,
                'multiple' => false,
                'options' => ['disabled' => false],
            ]) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'desc')->textarea(['maxlength' => true]) ?>

            <?= $form->field($model, 'content')->widget(UEditor::className(), [
                'clientOptions' => [
                    'toolbars' => [
                        [
                            'fullscreen', 'source', 'preview', '|', 'bold', 'italic', 'underline', 'strikethrough', 'forecolor', 'backcolor', '|',
                            'justifyleft', 'justifycenter', 'justifyright', '|', 'insertorderedlist', 'insertunorderedlist', 'blockquote', 'emotion',
                            'link', 'removeformat', '|', 'rowspacingtop', 'rowspacingbottom', 'lineheight', 'indent', 'paragraph', 'fontsize', '|',
                            'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol',
                            'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', '|', 'anchor', 'map', 'print', 'drafts'
                        ],
                    ],
                ]
            ]) ?>
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
                <button type="button" class="btn btn-default" onclick="selectFilesDialog({ele:this,num:1,type:1,name:'Activity[fid]'})">
                    <i class="fa fa-file-image-o" style="color:#dd551a;"></i><span class="hidden-xs">封面图片</span>
                </button>
            </div>

            <?= $form->field($join, 'reg')->textInput() ?>

            <?= $form->field($join , 'reg_adds')->textInput() ?>

            <?= $form->field($join, 'reg_time')->widget(DateTimePicker::className(),[
                'language' => 'zh-CN',
                'name' => 'date_from',

                'options' => [
                    'autoclose' => true,
                    'value' =>  date('Y-m-d H:i:s', $join->reg_time ? $join->reg_time : time()),
                ],
                'clientOptions' => [
                    'autoclose' => true,
                    'minView' => 1,
                    'format' => 'yyyy-mm-dd hh:mm:ss',
                    'todayBtn' => true
                ],
            ]) ?>

            <?= $form->field($join, 'act_adds')->textInput()->label(Yii::t('app','Activity Adds')) ?>

            <?= $form->field($join, 'act_time')->widget(DateTimePicker::className(),[
                'language' => 'zh-CN',
                'name' => 'date_from',

                'options' => [
                    'autoclose' => true,
                    'value' =>  date('Y-m-d H:i:s', $join->act_time ? $join->act_time : time()),
                ],
                'clientOptions' => [
                    'autoclose' => true,
                    'minView' => 1,
                    'format' => 'yyyy-mm-dd hh:mm:ss',
                    'todayBtn' => true
                ],
            ])->label(Yii::t('app','Activity Time')) ?>

            <?= $form->field($join, 'reg_url')->textInput() ?>

            <?= $form->field($model, 'top',[
                'template' => '<div class="pull-left">{input}</div><div class="pull-left">{error}</div>'
            ])->checkBox() ?>

            <?= $form->field($model, 'rec',[
                'template' => '<div class="pull-left" style="margin-left: 30px;">{input}</div><div class="pull-left">{error}</div>'
            ])->checkBox() ?>

            <?= $form->field($model, 'created_at')->hiddenInput(['value' => date('Y-m-d H:i:s', $model->isNewRecord ? time() : $model->created_at)])->label(false) ?>

            <div class="form-group">
                <div class="clearfix"></div>
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
.files-insert .btn{position:absolute;top:50%;left:50%;margin:-17px 0 0 -47px;display:inline;}
.files-insert .image-items {display:block;overflow:hidden;list-style:none;padding:0;margin:0;}
.files-insert .image-items .item {padding:15px;}
.files-insert .image-items .item img{position:relative; width:100%; height:190px;z-index:1;}
.files-insert .image-items .image-close {position:absolute;top:3px;right:3px;cursor:pointer;font-size:16px;color:#e05a5a;}
.files-insert .image-items .image-close:hover{color:#cc1515;}
.files-insert .input-items .has-error{position:absolute;top:50%;left:50%;margin:-40px 0 0 -63px;}
CSS;
$this->registerCSS($css);
?>