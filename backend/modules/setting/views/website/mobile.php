<?php

/**
 * Created by getpu on 16/8/23.
 */

$this->title = '手机版信息';
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
                <?php $form = \yii\widgets\ActiveForm::begin([
                    'id' => 'website',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-sm-offset-2 col-lg-8\">{error}\n{hint}</div>",
                        'labelOptions' => ['class' => 'col-lg-2 control-label'],
                    ],
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                ])?>
                <?= $form->field($model, 'mobile_site') ?>
                <?= $form->field($model, 'mobile_title') ?>
                <?= $form->field($model, 'mobile_mobile') ?>
                <?= $form->field($model, 'mobile_email') ?>
                <?= $form->field($model, 'mobile_address') ?>
                <?= $form->field($model, 'mobile_keywords') ?>
                <?= $form->field($model, 'mobile_description') ?>
                <?= $form->field($model, 'mobile_icp') ?>
                <?= $form->field($model, 'mobile_copyright')->textarea() ?>
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


