<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use getpu\ueditor\UEditor;
use yii\bootstrap\Modal;
use dosamigos\datetimepicker\DateTimePicker;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/**
 * Created by getpu on 16/9/6.
 */

?>

    <div class="fron-entrepreneurial-form">

        <ul class="nav nav-tabs">
            <li class="active"><a href="#assort" data-toggle="tab">赛事</a></li>
            <?php if (!$model->isNewRecord) : ?>
                <li><a href="#result" data-toggle="tab">历年成绩</a></li>
            <?php endif ?>
        </ul>

        <div class="tab-content">
            <div id="assort" class="tab-pane fade in active">
                <?php $form = ActiveForm::begin([]) ?>

                <div class="col-xs-12 col-md-9 panel panel-default">
                    <div class="panel-body">

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
                                <?php if (!$model->isNewRecord) : ?>
                                    <li class="item item-<?= $model->files->id ?>">
                                        <img
                                            src="<?= $model->files->host . DIRECTORY_SEPARATOR . $model->files->name ?>"/>
                                        <i class="fa fa-times-circle image-close"></i>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <ul class="input-items">
                                <?= $form->field($model, 'fid')->hiddenInput(['maxlength' => true])->label(false) ?>
                            </ul>
                            <ul class="clearfix"></ul>
                            <button type="button" class="btn btn-default"
                                    onclick="selectFilesDialog({ele:this,num:1,type:1,name:'CompetitionAssort[fid]'})">
                                <i class="fa fa-file-image-o" style="color:#dd551a;"></i><span
                                    class="hidden-xs">封面图片</span>
                            </button>
                        </div>

                        <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'clicked')->textInput() ?>

                        <?= $form->field($model, 'created_at')->widget(DateTimePicker::className(), [
                            'language' => 'zh-CN',
                            'name' => 'date_from',

                            'options' => [
                                'autoclose' => true,
                                'value' => date('Y-m-d H:i:s', $model->created_at ? $model->created_at : time()),
                            ],
                            'clientOptions' => [
                                'autoclose' => true,
                                'minView' => 2,
                                'format' => 'yyyy-mm-dd hh:mm:ss',
                                'todayBtn' => true
                            ],
                        ]) ?>

                        <?= $form->field($model, 'top', [
                            'template' => '<div class="pull-left">{input}</div><div class="pull-left">{error}</div>'
                        ])->checkBox() ?>

                        <?= $form->field($model, 'rec', [
                            'template' => '<div class="pull-left" style="margin-left: 30px;">{input}</div><div class="pull-left">{error}</div>'
                        ])->checkBox() ?>

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
            </div><!-- assort -->

            <?php if (!$model->isNewRecord) : ?>
                <div id="result" class="tab-pane fade">
                    <?= Html::a('添加成绩', 'javascript:;', [
                        'id' => 'create',
                        'data-toggle' => 'modal',
                        'data-target' => '#create-modal',
                        'class' => 'fa fa-plus-circle btn btn-success',
                    ]); ?>

                    <?php Modal::begin([
                        'id' => 'create-modal',
                        'header' => '<h4 class="modal-title">添加成绩</h4>',
                      //  'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
                    ]) ?>
                    <ul class="nav nav-tabs">
                        <li><a href="#modal-tags" data-toggle="tab">标签</a></li>
                        <li class="active"><a href="#modal-result" data-toggle="tab">成绩</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="modal-tags" class="tab-pane fade in"><?= $this->render('_tags',['model' => $tags, 'tags_list' => $tags_list]) ?></div>
                        <div id="modal-result" class="tab-pane fade active in"><?= $this->render('_result', ['model' => $result, 'tags_list' => $tags_list]) ?></div>
                    </div>

                    <?php Modal::end() ?>
                   <?php Pjax::begin() ?>
                    <div class="data-item">
                        <?=GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel'  => $searchModel,
                            'columns' => [
                                [
                                    'attribute' => 'tid',
                                    'headerOptions' => ['style' => 'width:120px;'],
                                    'format' => 'raw',
                                    'value' => function($model){
                                        return $model->tags->tag;
                                    },
                                    'filter' => Html::activeDropDownList($searchModel,
                                        'tid',
                                        ArrayHelper::map($tags_list, 'id', 'tag'),
                                        ['class' => 'form-control', 'style' => 'padding:0px', 'prompt' => '---']
                                    ),
                                ],
                                'title',
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => '操作',
                                    'options' => ['style' => 'width:50px'],
                                    'template' => '{delete}',
                                    'buttons' =>  [
                                       'delete' => function($url, $model, $key){
                                           $options = [
                                               'title' => Yii::t('yii', 'Delete'),
                                               'aria-label' => Yii::t('yii', 'Delete'),
                                               'data-pjax' => '0',
                                               'data-confirm' => Yii::t('yii', '您确定要删除此项？'),
                                               'data-method' => 'post',
                                           ];
                                           $url = \yii\helpers\Url::to(['delete-result','id' => $key]);
                                           return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options);
                                       }
                                    ],
                                ],
                            ],
                         ]) ?>
                    </div>
                    <?php Pjax::end() ?>

                </div>
            <?php endif ?>

        </div>


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