<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use getpu\ueditor\UEditor;
use backend\modules\cms\models\FronCompetition;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $competition backend\modules\cms\ */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fron-competition-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-xs-12 col-md-9 panel panel-default">
      <div class="panel-body">
        <div class="form-group files-insert">
            <ul class="image-items">
                <?php if(!$model->fronArticle->isNewRecord) : ?>
                    <li class="item item-<?=$model->fronArticle->files->id?>">
                        <img src="<?= $model->fronArticle->files->host .DIRECTORY_SEPARATOR .$model->fronArticle->files->name ?>"/>
                        <i class="fa fa-times-circle image-close"></i>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="input-items">
                <?= $form->field($model->fronArticle, 'fid')->hiddenInput(['maxlength' => true])->label(false) ?>
            </ul>
            <ul class="clearfix"></ul>
            <button type="button" class="btn btn-default" onclick="selectFilesDialog({ele:this,num:1,type:1,name:'FronArticle[fid]'})">
                <i class="fa fa-file-image-o" style="color:#dd551a;"></i><span class="hidden-xs">封面图片</span>
            </button>
        </div>
      </div>
        <?= $form->field($model->fronArticle, 'cid')->hiddenInput(['value' => FronCompetition::$cid])->label(false) ?>
        <?= $form->field($model->fronArticle, 'content')->widget(UEditor::className(), [
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

    <div class="col-xs-12 col-md-3 panel panel-default">
        <div class="panel-body">

            <?= $form->field($model->fronArticle, 'title')->textInput() ?>

            <?= $form->field($model->fronCompetition, 'str_time')->widget(DateTimePicker::className(),[
                'language' => 'zh-CN',
                'name' => 'date_from',

                'options' => [
                    'autoclose' => true,
                    'value' =>  date('Y-m-d H:i:s', $model->fronCompetition->str_time ? $model->fronCompetition->str_time : time()),
                ],
                'clientOptions' => [
                    'autoclose' => true,
                    'minView' => 2,
                    'format' => 'yyyy-mm-dd hh:mm:ss',
                    'todayBtn' => true
                ],
            ]) ?>

            <?= $form->field($model->fronCompetition, 'end_time')->widget(DateTimePicker::className(),[
                'language' => 'zh-CN',
                'name' => 'date_from',

                'options' => [
                    'autoclose' => true,
                    'value' =>  date('Y-m-d H:i:s', $model->fronCompetition->end_time ? $model->fronCompetition->end_time : time()),
                ],
                'clientOptions' => [
                    'autoclose' => true,
                    'minView' => 2,
                    'format' => 'yyyy-mm-dd hh:mm:ss',
                    'todayBtn' => true
                ],
            ]) ?>

            <?= $form->field($model->fronArticle, 'created_at')->hiddenInput(['value' => date('Y-m-d H:i:s', $model->fronArticle->isNewRecord ? time() : $model->fronArticle->created_at)])->label(false) ?>

            <?php if(!$model->fronCompetition->isNewRecord) : ?>
            <div class="form-group">
               <div class="alert <?= $model->fronCompetition->end_time > time() ? 'alert-info' : 'alert-danger' ?>">
                   <?= $model->fronCompetition->end_time > time() ? Yii::t('app', 'Competition active') : Yii::t('app', 'Competition over') ?>
                   <i href="#" class="close" data-dismiss="alert">&times;</i>
               </div>
            </div>
            <?php endif ?>

            <div class="form-group">
                <?= Html::submitButton($model->fronArticle->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->fronArticle->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="clearfix"></div>
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
