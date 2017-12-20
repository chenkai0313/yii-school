<?php

use getpu\ueditor\UEditor;

/**
 * Created by getpu on 16/8/23.
 */
$this->title = '网站信息';
$this->params['breadcrumbs'] = [
    ['label' => '系统设置'],
    ['label' => $this->title],
];
?>

<div class="row">
    <div class="col-md-2">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <span class="title">详细信息设置</span>
                </div>
            </div>
            <div class="panel-body">
                <?php
                $form = \yii\widgets\ActiveForm::begin([
                            'id' => 'website',
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
                                'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-sm-offset-2 col-lg-8\">{error}\n{hint}</div>",
                                'labelOptions' => ['class' => 'col-lg-2 control-label'],
                            ],
                            'enableAjaxValidation' => false,
                            'enableClientValidation' => false,
                            'validateOnBlur' => false,
                        ])
                ?>
                <?= $form->field($model, 'web_site') ?>
                <?= $form->field($model, 'web_title') ?>
                <?= $form->field($model, 'web_phone') ?>
                <?= $form->field($model, 'web_fax') ?>
                <?= $form->field($model, 'web_email') ?>
                <?= $form->field($model, 'web_address') ?>
                <?= $form->field($model, 'web_keywords') ?>
                <?= $form->field($model, 'web_description') ?>
                <?= $form->field($model, 'web_icp') ?>
                <?= $form->field($model, 'web_copyright')->textarea() ?>

                <?=
                $form->field($model, 'web_intro')->widget(Ueditor::className(), [
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
                ])
                ?>
                <?=
                $form->field($model, 'web_institution')->widget(Ueditor::className(), [
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
                ])
                ?>

                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-8">
                        <?= \yii\helpers\Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-block btn-success']) ?><br>
                    </div>
                </div>
                <?php \yii\widgets\ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>

<?= $this->render('@backend/modules/files/views/file/layout') ?>
